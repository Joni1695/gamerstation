<?php
  class Feedback_model extends CI_Model{
    public function get_unread_feedback(){
      $feed=$this->db->select('*')->from('feedback')->get()->result();
      return $feed;
    }
    public function delete($id){
      $feed=$this->db->where('id',$id)->delete('feedback');
      return $feed;
    }
    public function add_feedback(){
      $data=array(
        'name' => htmlentities($this->input->post('name')),
        'contact' => htmlentities($this->input->post('contact')),
        'text' => htmlentities($this->input->post('message'))
      );
      return $this->db->insert('feedback',$data);
    }
  }
 ?>
