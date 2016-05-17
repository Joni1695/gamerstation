<?php
  class Helper_model extends CI_Model{
    public function get_categories(){
      return $this->db->select('*')->from('categories')->get()->result();
    }
    public function get_platforms(){
      return $this->db->select('*')->from('platform')->get()->result();
    }
  }
 ?>
