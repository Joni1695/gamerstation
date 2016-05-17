<?php
  class Admin extends CI_Controller {
    public function __construct(){
      parent::__construct();
      if($this->session->userdata('status')!='admin') show_404();
    }
    public function index(){
      $data=array(
        'active' => 'admin_dashboard'
      );
      $this->load->view('adminMain',$data);
    }
    public function landing(){
      $fp=$this->Product_model->get_first_page();
      $products=$this->Product_model->get_admin_products();
      $ratings=array();
      foreach($fp as $product){
        $rating[]=$this->Rating_model->get_product_rating($product->id);
      }
      $data=array(
        'active' => 'admin_landing',
        'products' => $fp,
        'ratings' => $ratings,
        'changeproducts' => $products
      );
      $this->load->view('adminMain',$data);
    }
    public function products(){
      $products=$this->Product_model->get_admin_products();
      $rating=array();
      foreach($products as $product){
        $rating[]=$this->Rating_model->get_product_rating($product->id);
      }
      $data=array(
        'active' => 'admin_products',
        'products' => $products,
        'ratings' => $rating
      );
      $this->load->view('adminMain',$data);
    }
    public function users(){
      $users=$this->User_model->get_users();
      $data=array(
        'users' => $users,
        'active' => 'admin_users'
      );
      $this->load->view('adminMain',$data);
    }
    public function orders(){
      $orders=$this->Product_model->get_orders();
      $data=array(
        'active' => 'admin_orders',
        'orders' => $orders
      );
      $this->load->view('adminMain',$data);
    }
    public function threads(){
      $threads=$this->Product_model->get_all_reported_threads();
      $data=array(
        'active' => 'admin_threads',
        'threads' => $threads
      );
      $this->load->view('adminMain',$data);
    }
    public function feedback(){
      $feedback=$this->Feedback_model->get_unread_feedback();
      $data=array(
        'active' => 'admin_feedback',
        'feedback' => $feedback
      );
      $this->load->view('adminMain',$data);
    }


    public function delUpGame(){
      if($this->input->post('id')){
        if($this->input->post('delete_game')==='notempty'){
          if(!$this->Product_model->deleteGame($this->input->post('id'))) $this->session->set_flashdata('deletefail','Game was not deleted.');
          else $this->session->set_flashdata('deletesuccess','Game was deleted.');

        } else if($this->input->post('update_game')==='notempty'){

          $this->form_validation->set_rules('name','Game title', 'trim|required');
    			$this->form_validation->set_rules('desc','Game description','trim|required');
    			$this->form_validation->set_rules('trailer','Game trailer','trim|required');
    			$this->form_validation->set_rules('price','Game price','trim|required|numeric');
          if($this->form_validation->run()==false){
            redirect('adminpanel/products');
          } else{
            if($this->Product_model->updateGame($this->input->post('id'))){
              $this->session->set_flashdata('updatesuccess','Game was succesfully updated!');
              redirect('adminpanel/products');
            }
            else{
              $this->session->set_flashdata('updatefail','Game was not succesfully updated!');
              redirect('adminpanel/products');
            }
          }

        }
        redirect('adminpanel/products');
      }
      redirect('adminpanel/products');

    }

    public function createGame(){
      $this->form_validation->set_rules('name','Game title', 'trim|required');
      $this->form_validation->set_rules('desc','Game description','trim|required');
      $this->form_validation->set_rules('trailer','Game trailer','trim|required');
      $this->form_validation->set_rules('price','Game price','trim|required|numeric');
      if($this->form_validation->run()==false){
        $data=array(
          'active' => 'admin_products_create',
        );
        $this->load->view('adminMain',$data);
      } else{
        if($this->Product_model->createGame($this->input->post('id'))){
          $this->session->set_flashdata('createsuccess','Game was succesfully created!');
          redirect('adminpanel/products');
        }
        else{
          $data=array(
            'active' => 'admin_products_create',
          );
          $this->load->view('adminMain',$data);
        }
      }
    }

    public function changePage(){
      if($this->input->post('oldValue') && $this->input->post('newValue')){

        if($this->Product_model->changeFirst($this->input->post('oldValue'),$this->input->post('newValue'))){
          $this->session->set_flashdata('changesuccess','First page game was changed successfully.');
          redirect('adminpanel/landing');
        } else {
          $this->session->set_flashdata('changefail','First page game was not changed successfully.');
          redirect('adminpanel/landing');
        }
      } else{
        $this->session->set_flashdata('changefail','First page game was not changed successfully.');
        redirect('adminpanel/landing');
      }
    }

  }
 ?>
