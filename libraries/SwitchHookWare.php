<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class SwitchHookWare
{
  protected $groups = 'all,root';
  protected $signature;
  protected $routes;
  protected $ci;

  /**
   * [__construct description]
   * @date 2019-12-14
   */
  final function __construct()
  {
    $this->ci =& get_instance();
  }
  /**
   * bail Call when you do not want any other hookware to run. This acually falls
   * through all declared hookwares.
   * @date 2019-12-14
   */
  protected final function bail(string $hookware):void
  {
    set_config_item('hookware_next', false);
  }
  /**
   * [should_handle description]
   * @date   2019-12-14
   * @return bool       [description]
   */
  protected final function should_handle():bool
  {
    // Should I Bail?
    if (!get_config_item('hookware_next', true)) return false;

    // Am I Global?
    if (strpos($this->groups, 'all') !== false) return true;

    // Am I supposed to run on the Home Page (Default Controller).
    if ($this->ci->router->hookware == 'root' && strpos($this->groups, 'root') !== false) return true;

    // Do we have captured groups from the router class?
    if (count($this->ci->router->hwgroups) > 0) {

      if (!is_array($this->groups)) {
        $this->groups = explode(',', $this->groups);
      }

      array_walk($this->groups, function (&$group) {
        $group = "^\\+$group$";
      });

      $this->groups = implode('|', $this->groups);

      foreach ($this->ci->router->hwgroups as $groups => $value) {
        if (!$value) return false;
        $groups = preg_replace('/(@group{|})/', '', $groups);
        $groups = explode(',', $groups);
        $groups = preg_grep("/($this->groups)/", $groups);
        if (count($groups) > 0 && $value) return true;
      }

      if ($this->ci->router->hookware === "+$this->signature") return true;
    }

    return false;
  }
  /**
   * [startup description]
   * @date  2019-12-14
   * @param string     $args [description]
   */
  public final function startup($args=''):void
  {
    if ($this->should_handle()) $this->handle($args);
  }
  /**
   * [abstract{handle} Handle/Execute the HookWare. Override to execute your
   * instructions.]
   */
  public abstract function handle($args):void;
}
