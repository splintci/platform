<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Platform {

  private $packages_root;

  function __construct() {
    $this->packages_root = APPPATH . "splints/";
  }
  /**
   * [getInstalledPackages List out all currently installed packages within the
   *                       distribution.]
   *                       
   * @return array         An array of installed packages.
   */
  function getInstalledPackages() {
    $installed = array();
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
   *
   * @param  string $package  The name of the package to retrieve its version.
   *
   * @return string           The version of the given package.
   */
  function getPackageVersion($package) {
    if (is_file($this->packages_root . "$package/splint.json"))
    $descriptor = json_decode(file_get_contents($this->packages_root . "$package/splint.json"));
    if (isset($descriptor->version)) return str_replace("v", "", $descriptor->version);
    return false;
  }
  /**
   * [filterDirectories       Filter out teh given arrays and return only valid
   *                          directories based on the combination of $rootDir
   *                          and elements of $dir.]
   *
   * @param  string $rootDir  Root directory to check the validity of the
   *                          elements of $dir with.
   *
   * @param  array  $dirs     Array of possibel directory names.
   *
   * @return array            Array of valid directory names.
   */
  function filterDirectories($rootDir, $dirs) {
    $directories = array();
    foreach ($dirs as $dir) {
      if (is_dir($rootDir . $dir)) $directories[] = $dir;
    }
    return $directories;
  }
}
?>
