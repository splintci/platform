<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class HookWare
{
  public final function startup($args=''):void
  {
    
  }
  public abstract function handle():void;
}
