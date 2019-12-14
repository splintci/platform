<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class AsyncJobDispatcher
{
  /**
   * [protected description]
   * @var [type]
   */
  protected $args;
  /**
   * [protected description]
   * @var [type]
   */
  protected $class;
  /**
   * [__construct description]
   * @date  2019-12-03
   * @param array      $args [description]
   */
  function __construct($class, ...$args)
  {
    $this->class = $class;
    $this->args = $args;
  }
  /**
   * [dispatch description]
   * @date 2019-12-03
   */
  public function dispatch():void
  {
    exec('bash -c "nohup setsid php index.php CLIController '.$this->class.' '.implode(' ', $this->args).' > /dev/null 2>&1 &"');
  }
}
