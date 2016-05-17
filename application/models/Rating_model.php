<?php
  class Rating_model extends CI_Model{
    public function get_product_rating($id){
      $rating=$this->db->select_avg('rating')->from('user_ratings')->where('fk_product_id',$id)->get();
      return $rating->result();
    }
  }
 ?>
