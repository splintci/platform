<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class AppEventListener
{
  /**
   * [abstract description]
   * @var [type]
   */
  abstract public function handle($event):void;
  /**
   * [getData description]
   * @date   2019-12-22
   * @param  string|null    $previousListener [description]
   * @return [type]                       [description]
   */
  public function getData(?string $previousListener)
  {
    return null;
  }
}
