<?php
  class Users extends CI_Controller{
    public function login(){
      $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[16]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]');

			if($this->form_validation->run() == FALSE){
				//Show View
				$data=array(
          'mainContent' => 'login',
        );
        $this->load->view('main',$data);
			} else {
					$username=$this->input->post('username');
					$password=$this->input->post('password');
					$user_id= $this->User_model->login($username,$password);
				//Validate user
				if($user_id){
          if($user_id->error=='banned'){
            $this->session->set_flashdata('ban_login','Sorry this account has been banned. If you think this is a mistake, then you should contact the administrators.');
  					redirect('login');
          }
					//Create array of user data
					$data = array(
						'user_id' 	=> $user_id->id,
						'username' 	=> $username,
						'logged_in' => true,
						'status' => $user_id->status
					);
					//Set session userdata
					$this->session->set_userdata($data);
					redirect('main');
				}else if($user_id==false){
					//Set Error
					$this->session->set_flashdata('fail_login','Sorry the login info is not correct.');
					redirect('login');
				}
			}
    }

    public function logout(){
			//Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
      $this->session->unset_userdata('status');
			$this->session->sess_destroy();

			redirect('main');
		}

    public function signup(){
			//Validation Rules
			$this->form_validation->set_rules('first_name','First Name', 'trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[16]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]');
			$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');

			if($this->form_validation->run() == FALSE){
				//Show View
				$data['mainContent'] = 'signup';
				$this->load->view('main', $data);
			}else{

				if($this->User_model->register()){
					$this->session->set_flashdata('registered','You are now registered and can login.');
					redirect('main');
				}
				else{
					$this->session->set_flashdata('signupfail','The username or email you used already has an account.');
					$data['mainContent'] = 'signup';
					$this->load->view('main', $data);
				}
			}
		}

    public function profile(){
      if($this->session->userdata('user_id')){
        $this->form_validation->set_rules('first_name','First Name', 'trim|required');
    		$this->form_validation->set_rules('last_name','Last Name','trim|required');
    		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
    		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|max_length[16]');
    		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]');

    		if($this->form_validation->run() == FALSE){
          $data['user']=$this->User_model->get_userdata();
    			$data['mainContent'] = 'profile';
    			$this->load->view('main', $data);
    		}else{
    			if($this->User_model->edit()){
    				$this->logout();
    				redirect('main');
    			}
    			else{
            $data['user']=$this->User_model->get_userdata();
    				$this->session->set_flashdata('editfail','The username or email you used already has an account.');
    				$data['mainContent'] = 'profile';
    				$this->load->view('main', $data);
    			}
    		}
      } else redirect('login');
    }
    public function mypurchases(){
      if($this->session->userdata('user_id')){
        $myorders=$this->User_model->get_my_orders($this->session->userdata('user_id'));
        $data=array(
          'mainContent' => 'orders',
          'orders' => $myorders
        );
        $this->load->view('main',$data);
      } else redirect('login');
    }

  }
 ?>
