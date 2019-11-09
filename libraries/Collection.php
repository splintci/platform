<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Collection
{
  /**
   * [protected description]
   * @var [type]
   */
  protected $items;
  /**
   * [__construct ]
   * @date  2019-11-09
   * @param [type]     $items [description]
   */
  function __construct($items)
  {
    $this->items = $items;
  }
  /**
   * [all Returns the underlying array represented by the collection]
   * @date   2019-11-09
   * @return array      The underlying array represented by the collection.
   */
  public function all():array
  {
    return $this->items;
  }
  public function avg(string $key=null):int
  {
    
  }
}
