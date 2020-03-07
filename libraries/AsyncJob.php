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
   * [protected $phpBinary Path to the PHP binary used to run the job.]
   * @var string
   */
  public $phpBinary = 'php';

  /**
   * [protected $env Environmental Variables use to run the job.]
   * @var array
   */
  public $env = [];

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
