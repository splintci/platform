<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Platform {

  private $packages_root;

  private const PACKAGE = 'splint/platform';

  function __construct()
  {
    $this->packages_root = APPPATH . "splints/";

    spl_autoload_register(function($name) {
      if ($name == "CI_Model") {
        require(FCPATH.'system/core/Model.php');
        return;
      }
      $oldPath = set_include_path(APPPATH . 'splints/' . self::PACKAGE . '/libraries');
      if (file_exists(APPPATH . 'splints/' . self::PACKAGE . "/libraries/$name.php")) {
        require("$name.php");
      }
      set_include_path($oldPath);
    });

    // Jobs.
    spl_autoload_register(function ($name) {
      if (file_exists(APPPATH."jobs/$name.php")) {
        require(APPPATH."jobs/$name.php");
      }
    });
    // Events
    spl_autoload_register(function ($name) {
      if (file_exists(APPPATH."events/$name.php")) {
        require(APPPATH."events/$name.php");
      }
    });
    // Listeners
    spl_autoload_register(function ($name) {
      if (file_exists(APPPATH."listeners/$name.php")) {
        require(APPPATH."listeners/$name.php");
      }
    });

    get_instance()->load->splint(self::PACKAGE, '%platform');
    get_instance()->load->splint(self::PACKAGE, '%form_validation');
  }
  /**
   * [getInstalledPackages List out all currently installed packages within the
   *                       distribution.
   * @return array         An array of installed packages.
   */
  function getInstalledPackages():array {
    $installed = [];
    $vendors = $this->filterDirectories(
      $this->packages_root,
      array_diff(scandir($this->packages_root), array('.', '..')
    ));
    foreach ($vendors as $vendor) {
      $packages = $this->filterDirectories(
        $this->packages_root . $vendor . "/",
        array_diff(scandir($this->packages_root . $vendor . "/"), array('.', '..')
      ));
      foreach ($packages as $package) {
        $installed[] = $vendor . "/" . $package;
      }
    }
    return $installed;
  }

  /**
   * [getPackageVersion       Gets the version of the given package from its
   *                          descriptor.]
   * @param  string $package  The name of the package to retrieve its version.
   * @return string           The version of the given package.
   */
  function getPackageVersion(string $package):?string
  {
    if (is_file($this->packages_root . "$package/splint.json"))
    $descriptor = json_decode(file_get_contents($this->packages_root . "$package/splint.json"));
    if (isset($descriptor->version)) return str_replace("v", "", $descriptor->version);
    return null;
  }

  /**
   * [getPackageAliases description]
   * @param  string $package [description]
   * @return [type]          [description]
   */
  function getPackageAliases(string $package=null):?string
  {
    if ($package ==  null) return null;
    if (is_file($this->packages_root . "$package/splint.json"))
    $descriptor = json_decode(file_get_contents($this->packages_root . "$package/splint.json"), true);
    if (isset($descriptor['autoload']['libraries'])) {
      $aliases = [];
      foreach ($descriptor['autoload']['libraries'] as $autoload) {
        if (count($autoload) == 3) {
          $aliases[] =  $autoload[2];
        } else if (count($autoload) == 2 && substr($autoload[1], 0, 1) != '@') {
          $aliases[] = $autoload[1];
        }
      }
      if (count($aliases) == 1) return $aliases[0];
      if (count($aliases) > 0) return $aliases;
      if (count($descriptor['autoload']['libraries']) > 0) {
        return $descriptor['autoload']['libraries'][0][0];
      }
    }
    return null;
  }

  /**
   * [filterDirectories       Filter out teh given arrays and return only valid
   *                          directories based on the combination of $rootDir
   *                          and elements of $dir.]
   * @param  string $rootDir  Root directory to check the validity of the
   *                          elements of $dir with.
   * @param  array  $dirs     Array of possibel directory names.
   * @return array            Array of valid directory names.
   */
  function filterDirectories(string $rootDir, array $dirs):array
  {
    $directories = [];
    foreach ($dirs as $dir) {
      if (is_dir($rootDir . $dir)) $directories[] = $dir;
    }
    return $directories;
  }

  /**
   * [validateInput description]
   * @date   2020-04-11
   * @param  string     $group [description]
   * @param  boolean    $exit  [description]
   * @param  [type]     $data  [description]
   * @return bool              [description]
   */
  public function validateInput(string $group, bool $exit=false, array $data=[]):bool
  {
    $ci =& get_instance();
    $ci->load->library('form_validation');
    $ci->form_validation->set_data(array_merge($ci->input->input_stream(null, true), $data));    

    if ($ci->form_validation->run($group)) return true;

    if ($exit) {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'errors' => $ci->form_validation->error_array()
      ], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
      exit(EXIT_USER_INPUT);
    }

    return false;
  }
}
