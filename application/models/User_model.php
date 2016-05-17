<?php
	class User_model extends CI_Model{
		public function get_users(){
			$this->db->select('*');
			$this->db->from('users');
			return $this->db->get()->result();
		}
		public function register(){
			$data = array(
			'first_name' => htmlentities($this->input->post('first_name')),
			'last_name' => htmlentities($this->input->post('last_name')),
			'email' 	=> htmlentities($this->input->post('email')),
			'username' => htmlentities($this->input->post('username')),
			'password' => htmlentities(md5($this->input->post('password'))),
			'status' => htmlentities('user'),
			'banned' => htmlentities('N')
			);
			return $this->db->insert('users', $data);
		}

		public function login($username,$password){
			//Validate
			$this->db->where('username', htmlentities($username));
			$this->db->where('password', md5(htmlentities($password)));

			$result = $this->db->get('users');
			if($result->num_rows() == 1){
				$result=$result->row();
				if($result->banned=='Y') $result->error='banned';
				return $result;
			}else{
				return false;
			}
		}
		public function get_userdata(){
			$this->db->where('id',$this->session->userdata('user_id'));
			$result =$this->db->get('users');
			if($result->num_rows() == 1){
				return $result->row(0);
			}else{
				return false;
			}
		}
		public function edit(){
			$data = array(
				'first_name' => htmlentities($this->input->post('first_name')),
				'last_name' => htmlentities($this->input->post('last_name')),
				'email' 	=> htmlentities($this->input->post('email')),
				'username' => htmlentities($this->input->post('username')),
				'password' => htmlentities(md5($this->input->post('password'))),
				'status' => $this->session->userdata('status'),
				'banned' => 'N'
			);
			return $this->db->where('id',$this->session->userdata('user_id'))->update('users',$data);
		}
		public function purchases(){
			$this->db->where('user_id',$this->session->userdata('user_id'));
			$result =$this->db->get('orders');
			return $result->result();
		}
		public function search($post){
			$searchterm=explode(" ",$this->input->post('search'));
			$this->db->select('*');
      $this->db->from('users');
      $i=0;
      $this->db->like('first_name',$searchterm[$i]);
			for($i=1;$i<sizeof($searchterm);$i++){
        $this->db->or_like('first_name',$searchterm[$i]);
      }
			for($i=0;$i<sizeof($searchterm);$i++){
				$this->db->or_like('last_name',$searchterm[$i]);
				$this->db->or_like('email',$searchterm[$i]);
				$this->db->or_like('username',$searchterm[$i]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_user_data($id){
			return $this->db->select('*')->from('users')->where('id',$id)->get()->result();
		}
		public function ban_user($id){
			$user=$this->db->select('*')->from('users')->where('id',$id)->get()->result();
			if($user[0]->banned=='Y') $this->db->where('id',$id)->update('users',array('banned' => 'N'));
			if($user[0]->banned=='N') $this->db->where('id',$id)->update('users',array('banned' => 'Y'));
		}
		public function change_user($id){
			$user=$this->db->select('*')->from('users')->where('id',$id)->get()->result();
			if($user[0]->status=='admin') $this->db->where('id',$id)->update('users',array('status' => 'user'));
			if($user[0]->status=='user') $this->db->where('id',$id)->update('users',array('status' => 'admin'));
		}
	}
?>
