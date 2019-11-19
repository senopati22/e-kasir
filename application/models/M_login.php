<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model
{
  function cek_login($table, $where)
  {
    return $this->db->get_where($table, $where);
  }
  function tampil($table, $where)
  {
    return $this->db->get_where($table, $where);
  }

  function get_AfterLogin($table, $where)
  {
    $this->db->select('admin.*, toko.*');
    $this->db->join('toko', 'admin.idtoko = toko.idtoko');
    return $this->db->get_where($table,$where);
    //return $query->result();
  }
}