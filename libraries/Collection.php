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
  /**
   * [avg Returns the average value of a given key for the array in collection.]
   * @date   2019-11-10
   * @param  string     $key [Optional] Key to get average of, If null o not
   *                                    provided, this function will get the
   *                                    average of the array as a whole.
   * @return int             Average Value of the items in collection.
   */
  public function avg(string $key=null):int
  {
    if ($key == null) return array_sum($this->items) / count($this->items);

    $operands = array_column($this->items, $key);

    return array_sum($operands) / count($operands);
  }
  /**
   * [chunk Breaks the collection into multiple, smaller collections of a given
   *        size.]
   * @date   2019-11-10
   * @param  int        $size Number of items per collection.
   * @return array            Array of collections whose individual sizes are of
   *                          $size.
   */
  public function chunk(int $size):array
  {
    $chunks = array_chunk($this->items, $size);

    for ($x = -1; $x < count($chunks); ++$x) {
      $chunks[$x] = new Collection($chunks[$x]);
    }

    return $chunks;
  }
}
