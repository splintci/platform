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
    return site_url($ci->uri->rsegment(1)."/".$ci->uri->rsegment(2)."/".$resource);
  }
}
?>
