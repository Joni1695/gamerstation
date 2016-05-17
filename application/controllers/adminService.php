<?php
  class AdminService extends CI_Controller{
    public function __construct(){
      parent::__construct();
      if($this->session->userdata('status')!='admin') show_404();
    }
    public function delete_feedback(){
      $data=array(
        'msg' => '',
        'type' => 'error'
      );
      if($this->input->post('feedback_id')){
        if($this->Feedback_model->delete($this->input->post('feedback_id'))){
          $data['msg']='Successfully deleted feedback item with id '.$this->input->post('feedback_id').'.';
          $data['type']='success';
        }
        else $data['msg']='An error ocurred and feedback item with id '.$this->input->post('feedback_id').' wasn\'t deleted.';
      }
      else $data['msg']='An error ocurred and feedback item with id '.$this->input->post('feedback_id').' wasn\'t deleted.';
      echo json_encode($data);
    }
    public function getGameData(){
      $data=array(
        'msg' => '',
        'type' => 'error'
      );
      if($this->input->post('game_id')){
        $product=$this->Product_model->get_game_data($this->input->post('game_id'));
        $rating=$this->Rating_model->get_product_rating($this->input->post('game_id'));
        if($product!=false){
          $data['product']=$product;
          $data['rating']=$rating;
          $data['type']='success';
        }
        else $data['msg']='An error ocurred and game data with id '.$this->input->post('game_id').' wasn\'t retrieved.';
      } else $data['msg']='An error ocurred and game data with id '.$this->input->post('game_id').' wasn\'t retrieved.';
      echo json_encode($data);
    }
    public function getUserData(){
      $data=array(
        'msg' => '',
        'type' => 'error'
      );
      if($this->input->post('user_id')){
        $product=$this->User_model->get_user_data($this->input->post('user_id'));
        if($product!=false){
          $data['user']=$product;
          $data['type']='success';
        }
        else $data['msg']='An error ocurred and game data with id '.$this->input->post('user_id').' wasn\'t retrieved.';
      } else $data['msg']='An error ocurred and game data with id '.$this->input->post('user_id').' wasn\'t retrieved.';
      echo json_encode($data);
    }
    public function banUser(){
      if($this->input->post('user_id')){
        $product=$this->User_model->ban_user($this->input->post('user_id'));
      }
    }
    public function changeUser(){
      if($this->input->post('user_id')){
        $product=$this->User_model->change_user($this->input->post('user_id'));
      }
    }
    public function resetReport(){
      if($this->input->post('thread_id')){
        $this->Product_model->resetRep($this->input->post('thread_id'));
      }
    }
    public function deleteThread(){
      if($this->input->post('thread_id')){
        $this->Product_model->deleteThread($this->input->post('thread_id'));
      }
    }
    public function delbanThread(){
      if($this->input->post('thread_id') && $this->input->post('user_id')){
        $this->Product_model->delbanThread($this->input->post('thread_id'),$this->input->post('user_id'));
      }
    }
  }
 ?>
