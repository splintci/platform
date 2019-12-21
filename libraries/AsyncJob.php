<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

abstract class AsyncJob
{
  /**
   * [protected description]
   * @var [type]
   */
  protected $args;
  /**
   * [__construct description]
   * @date  2019-12-03
   * @param array      $args [description]
   */
  function __construct(...$args)
  {
    $this->args = $args;
  }
  /**
   * [handle description]
   * @date 2019-12-04
   */
  abstract public function execute():int;
}
