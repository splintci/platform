<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('rule_group')) {
  function rule_group(string $group):array
  {
    if (!file_exists(APPPATH."validations/$group.php")) {
      throw new Exception("Validation rule group file $group.php does not exist.");
    }

    include APPPATH . "validations/$group.php";

    return $config;
  }
}
