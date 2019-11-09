<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SplintModel extends CI_Model
{
  /**
   * [protected description]
   * @var [type]
   */
  protected $table;
  protected $primaryKey = 'id';
  protected $userIdColumn = 'user_id';
  protected $userSessionIdKey = 'UID';
  /**
   * [protected description]
   * @var [type]
   */
  protected $userId;
  /**
   * [get description]
   * @date   2019-11-09
   * @param  int        $id [description]
   * @return [type]         [description]
   */
  public function get(int $id)
  {
    $this->db->where($this->primaryKey, $id);
    return $this->db->get($this->table)->result_array()[0];
  }
  /**
   * [get_user_resource description]
   * @date   2019-11-09
   * @return [type]     [description]
   */
  private function get_user_resource()
  {
    $this->db->where($this->userIdColumn, $this->session->userdata($this->userSessionIdKey));
    $query = $this->db->get($this->table);
    return $query->num_rows() > 0 ? $query->result_array() : [];
  }
  /**
   * [__call description]
   * @date   2019-11-09
   * @param  string     $method [description]
   * @param  array      $args   [description]
   * @return [type]             [description]
   */
  public function __call(string $method, array $args)
  {
    switch ($method)
    {
      case 'get' . str_replace('_', '', ucwords($this->table, '_')):
        return $this->get_user_resource();
    }
  }
}
?>
