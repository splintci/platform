<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class HookWare
{
  protected $ci;

  /**
   * [__construct description]
   * @date 2019-12-14
   */
  function __construct()
  {
    $this->ci =& get_instance();
  }

  /**
   * [abstract{handle} Handle/Execute the HookWare. Override to execute your
   * instructions.]
   */
  public abstract function handle($args):void;
  /**
   * [shouldHandleCLI description]
   * @date   2019-12-15
   * @return bool       [description]
   */
  public function shouldHandleCLI():bool {
    return false;
  }
  /**
   * [shouldHandle description]
   * @date   2019-12-15
   * @param  ?string    $matchedRoute [description]
   * @return bool                     [description]
   */
  public function shouldHandle(?string $matchedRoute):bool
  {
    return true;
  }
  /**
   * [except description]
   * @date   2019-12-15
   * @return [type]     [description]
   */
  public function except():?array
  {
    return [];
  }
}
