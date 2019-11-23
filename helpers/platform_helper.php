<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('asset_url')) {
  /**
   * [asset_url description]
   * @param [type] $splint   [description]
   * @param string $resource [description]
   */
  function asset_url($resource="") {
    $ci =& get_instance();
    return base_url("splint-assets/{$ci->config->item("splint")}/$resource");
  }
}

if (!function_exists('app_url')) {
  /**
   * [app_url description]
   * @param  string $resource [description]
   * @return [type]           [description]
   */
  function app_url($resource="") {
    $ci =& get_instance();
    return site_url($ci->uri->rsegment(1)."/".$ci->uri->rsegment(2).($ci->uri->segment(2) != null ? "/" : "").$resource);
  }
}

if (!function_exists('get_app_instance')) {
  /**
   * [get_app_instance description]
   * @return [type] [description]
   */
  function &get_app_instance() {
    return SplintAppController::get_instance();
  }
}

if (!function_exists('dd')) {
  /**
   * [dd description]
   * @date   2019-11-23
   * @param  [type]     $var [description]
   * @return [type]          [description]
   */
  function dd($var) {
    var_dump($var);
    exit(EXIT_SUCCESS);
  }
}

if (!function_exists('collect')) {
  /**
   * [collect description]
   * @date   2019-11-02
   * @param  array      $array [description]
   * @return [type]            [description]
   */
  function collect(array $array)
  {
    return null;
  }
}
?>
