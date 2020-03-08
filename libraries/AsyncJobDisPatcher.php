<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class AsyncJobDisPatcher
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
    for ($x = 0; $x < count($this->args); $x++) {
      $this->args[$x] = rawurlencode(strval($this->args[$x]));
    }

    $class = new $this->class(...$this->args);
    $env = '';
    if (is_array($class->env)) {
      foreach ($class->env as $key => $value) {
        $env .= "$key=$value ";
      }
    }
    exec($env . 'bash -c "nohup setsid '. $class->phpBinary .' index.php CLIController '.$this->class.' '.implode(' ', $this->args).' > /dev/null 2>&1 &"');
  }

  /**
   * [dispatchNow description]
   * @date   2019-12-21
   * @return array      [description]
   */
  public function dispatchNow():array
  {
    $ci =& get_instance();
    $ci->benchmark->mark('job_start');
    $code = (new $this->class(...$this->args))->execute();
    $ci->benchmark->mark('job_end');
    return [$code, $ci->benchmark->elapsed_time('job_start', 'job_end')];
  }
}
