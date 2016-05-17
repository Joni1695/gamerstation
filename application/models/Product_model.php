<?php
  class Product_model extends CI_Model{
    //PRODUCTS
    public function get_games_autocomplete(){
      return $this->db->select('products.id,products.title')->from('products')->get()->result();
    }
    public function get_reviews($id){
      return $this->db->select('reviews.text,users.username,users.id')->from('reviews')
      ->join('users','users.id=reviews.user_id','inner')->where('product_id',$id)
      ->get()->result();
    }
    public function add_review($id,$text){
      $data=array(
        'product_id' => $id,
        'text' => $text,
        'user_id' => $this->session->userdata('user_id')
      );
      $query=$this->db->select('*')->from('reviews')->where('product_id',$id)->where('user_id',$this->session->userdata('user_id'))->get();
      if($query->num_rows()==0) $this->db->insert('reviews',$data);
      else $this->db->where('product_id',$id)->where('user_id',$this->session->userdata('user_id'))->update('reviews',$data);
    }
    public function get_personal_rating($id){
      return $this->db->select('rating')->from('user_ratings')->where('fk_product_id',$id)->where('fk_user_id',$this->session->userdata('user_id'))->get()->result();
    }
    public function get_rating_user($id,$user_id){
      return $this->db->select('rating')->from('user_ratings')->where('fk_product_id',$id)->where('fk_user_id',$user_id)->get()->result();
    }
    public function rate_Game($rating,$id){
      $data=array(
        'fk_user_id' => $this->session->userdata('user_id'),
        'fk_product_id' => $id,
        'rating' => $rating
      );
      $query=$this->db->select('*')->from('user_ratings')->where('fk_product_id',$id)->where('fk_user_id',$this->session->userdata('user_id'))->get();
      if($query->num_rows()==0) $this->db->insert('user_ratings',$data);
      else $this->db->where('fk_product_id',$id)->where('fk_user_id',$this->session->userdata('user_id'))->update('user_ratings',$data);
    }
    public function get_first_products(){
	  return $this->db->limit(8)->select('products.id,products.title,products.price,products.gameImagePath')->select_avg('user_ratings.rating')
    ->from('products')
    ->join('user_ratings','user_ratings.fk_product_id=products.id','left')->group_by('products.id')
    ->order_by('created_at','desc')->get()->result();
    }
    public function get_game_data($id){
      $game=$this->db->select('products.id,products.gameImagePath,products.title,products.description,products.price,products.trailer_video,products.created_at')
      ->select_avg('user_ratings.rating')->from('products')->group_by('products.id')
      ->join('user_ratings','user_ratings.fk_product_id=products.id','left')
      ->where('products.id',$id)->get();
      if($game->num_rows()!=0) return $game->result();
      else return false;
    }
    public function get_gamecategories($id){
      return $this->db->select('categories_id')->from('categories_products')
      ->where('product_id',$id)->get()->result();
    }
    public function get_categoryname($id){
      $this->db->where('id',$id);
      $query=$this->db->get('categories');
      return $query->row(0)->name;
    }
    public function get_gameplatforms($id){
      return $this->db->select('platform_id')->from('platform_products')
      ->where('product_id',$id)->get()->result();
    }
    public function get_platformname($id){
      $this->db->where('id',$id);
      $query=$this->db->get('platform');
      return $query->row(0)->name;
    }

    public function get_first_page(){
      return $this->db->select('*')->from('products')
      ->join('first_products','products.id=first_products.product_id','inner')->get()->result();
    }
    public function changeFirst($oldvalue,$newvalue){
      $check=$this->db->select('*')->from('first_products')->where('product_id',$newvalue)->get()->result();
      if(sizeof($check)==0){
        $this->db->where('product_id',$oldvalue)->delete('first_products');
        $this->db->insert('first_products',array(
          'product_id' => $newvalue
        ));
        return true;
      }
      else return false;
    }
    public function get_recent_threads(){
      return  $this->db->limit(15,0)->select('threads.id,threads.title,threads.created_at,users.username')
      ->from('threads')->join('users','users.id=threads.user_id','left')->order_by('created_at','desc')->get()->result();
    }
    public function get_game_threads($id){
      return  $this->db->limit(10,0)->select('threads.id,threads.title,threads.created_at,users.username')
      ->from('threads')->join('users','users.id=threads.user_id','left')->where('product_id',$id)->order_by('created_at','desc')->get()->result();
    }
    public function get_last_thread($id){
      return  $this->db->limit(1,0)->select('threads.id,threads.title,threads.created_at,users.username')
      ->from('threads')->join('users','users.id=threads.user_id','left')->where('product_id',$id)->order_by('created_at','desc')->get()->result();
    }
    public function get_thread($id){
      return  $this->db->select('threads.id,threads.title,threads.desc,threads.created_at,users.username')
      ->from('threads')->join('users','users.id=threads.user_id','left')->where('threads.id',$id)->get()->result();
    }
    public function get_products($limit,$total,$mode,$searchterms){
	    $this->db->limit($limit,$total);
      $this->db->select('products.id,products.title,products.price,products.gameImagePath');
      $this->db->from('products');
      if($searchterms!=''){
        $searchterms=explode(' ',trim($searchterms,' '));
        for($i=0;$i<sizeof($searchterms);$i++){
          if($i==0) $this->db->like('products.title',$searchterms[$i]);
          else $this->db->or_like('products.title',$searchterms[$i]);
        }
      }
      if($mode==0) $this->db->order_by('id','desc');
      else if ($mode==1) {
        $this->db->order_by('title','asc');
      }
      else {
        $this->db->order_by('price','desc');
      }
      $query=$this->db->get();
      return $query->result();
    }
    public function removeThread($id){
      $this->db->where('id',$id)->delete('threads');
    }
    public function reportThread($id){
      $results=$this->db->select('*')->from('thread_reports')->where('thread_id',$id)
      ->where('user_id',$this->session->userdata('user_id'))->get();
      $data=array(
        'thread_id' => $id,
        'user_id' => $this->session->userdata('user_id')
      );
      if($results->num_rows()==0){
        $this->db->insert('thread_reports',$data);
      }
    }
    public function updateThread($id){
      $data=array(
        'title' => htmlentities($this->input->post('title')),
        'desc' => htmlentities($this->input->post('desc'))
      );
      $this->db->where('id',$id)->update('threads',$data);
    }
    public function createThread(){
      $data=array(
        'title' => htmlentities($this->input->post('thread_title')),
        'desc' => htmlentities($this->input->post('thread_desc')),
        'product_id' => htmlentities($this->input->post('game_id')),
        'user_id' => $this->session->userdata('user_id')
      );
      $this->db->insert('threads',$data);
    }
    public function countall($searchterms){
      $this->db->select('products.id,products.title,products.price,products.gameImagePath');
      $this->db->from('products');
      if($searchterms!=''){
        $searchterms=explode(' ',trim($searchterms,' '));
        for($i=0;$i<sizeof($searchterms);$i++){
          if($i==0) $this->db->like('products.title',$searchterms[$i]);
          else $this->db->or_like('products.title',$searchterms[$i]);
        }
      }
      $query=$this->db->count_all_results();
      return $query;
  	}

    public function get_products_by_query($sql){
      $query=$this->db->query($sql);
      return $query->result();
    }

    public function count_query($sql){
      $query=$this->db->query($sql);
      return $query->num_rows();
    }

    public function get_category_id($string){
      return $this->db->select('id')->from('categories')->where('name',$string)->get()->result();
    }
    public function get_platform_id($string){
      return $this->db->select('id')->from('platform')->where('name',$string)->get()->result();
    }

    public function get_product($id){
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where('id',$id);
      $query=$this->db->get();
      return $query->row();
    }
    public function get_categories(){
      $this->db->select('*');
      $this->db->from('categories');
      $query=$this->db->get();
      return $query->result();
    }
    public function get_popular(){
      $this->db->select('P.*, COUNT(O.product_id) AS total');
      $this->db->from('orders AS O');
      $this->db->join('products AS p','O.product_id = P.id','INNER');
      $this->db->group_by('O.product_id');
      $this->db->order_by('total','desc');
      $query=$this->db->get();
      return $query->result();
    }
    public function get_category_products($id,$mode){
      $this->db->select('*');
      $this->db->from('products');
      $this->db->like('category_id',$id);
      if($mode==0) $this->db->order_by('id','desc');
      else if ($mode==1) {
        $this->db->order_by('title','asc');
      }
      else {
        $this->db->order_by('price','desc');
      }
      $query=$this->db->get();
      return $query->result();
    }
    public function get_search_products($searchterm,$mode){
      $searchterm=explode(" ",$searchterm);
      $this->db->select('*');
      $this->db->from('products');
      $i=0;
      $this->db->like('title',$searchterm[$i]);
      for($i=1;$i<sizeof($searchterm);$i++){
        $this->db->or_like('title',$searchterm[$i]);
      }
      if($mode==0) $this->db->order_by('id','desc');
      else if ($mode==1) {
        $this->db->order_by('title','asc');
      }
      else {
        $this->db->order_by('price','desc');
      }
      $query=$this->db->get();
      return $query->result();
    }

    public function get_game_ratings($id){
      $query=$this->db->select_avg('rating')->from('user_ratings')->where('fk_product_id',$id)->get();
      return $query->result();
    }

    public function add_order($order_data){
			$insert = $this->db->insert('orders', $order_data);
			return $insert;
		}



    //ADMINPANEL
    public function get_admin_products($order='no',$category='no',$platform='no'){
      $games=$this->db->select('products.id,products.gameImagePath,products.title,products.description,products.price,products.trailer_video,products.created_at')
      ->select_sum('orders.qty')->from('products')->group_by('products.id')
      ->join('orders','orders.product_id=products.id','left')
      ->get();
      return $games->result();
    }
    public function deleteGame($id){
      return $this->db->where('id',$id)->delete('products');
    }
    public function updateGame($id){
      $data=array(
        'title' => htmlentities($this->input->post('name')),
  			'description' => htmlentities($this->input->post('desc')),
  			'trailer_video' 	=> htmlentities($this->input->post('trailer')),
  			'price' => htmlentities($this->input->post('price')),
      );
      if($_FILES['image1']['name']==''){
        $this->db->where('product_id',$id)->delete('categories_products');
        $CI=get_instance();
        foreach($this->input->post('categories') as $category){
          $category=$CI->Product_model->get_category_id($category);
          $categoryData=array(
            'product_id' => $id,
            'categories_id' => $category[0]->id
          );
          $this->db->insert('categories_products',$categoryData);
        }
        $this->db->where('product_id',$id)->delete('platform_products');
        foreach($this->input->post('platforms') as $platform){
          $platform=$CI->Product_model->get_platform_id($platform);
          $platformData=array(
            'product_id' => $id,
            'platform_id' => $platform[0]->id
          );
          $this->db->insert('platform_products',$platformData);
        }
        $this->db->where('id',$id);
        return $this->db->update('products',$data);
      } else{
        $image=$_FILES['image1']['name'];
        $allowedexts=array('png','jpg','jpeg');

        $ext= strtolower(substr($image,strrpos($image,'.')+1));
        if(in_array($ext,$allowedexts) === false ){
          $this->session->set_flashdata('badext','The allowed image types are png, jpg and jpeg.');
          return false;
        }
        $data['gameImagePath']='assets/images/game'.$id.'.'.$ext;
        if(move_uploaded_file($_FILES['image1']['tmp_name'],'assets/images/game'.$id.'.'.$ext)==false){
          echo "Failed";
          die();
        }

        $this->db->where('product_id',$id)->delete('categories_products');
        $CI=get_instance();
        foreach($this->input->post('categories') as $category){
          $category=$CI->Product_model->get_category_id($category);
          $categoryData=array(
            'product_id' => $id,
            'categories_id' => $category[0]->id
          );
          $this->db->insert('categories_products',$categoryData);
        }
        $this->db->where('product_id',$id)->delete('platform_products');
        foreach($this->input->post('platforms') as $platform){
          $platform=$CI->Product_model->get_platform_id($platform);
          $platformData=array(
            'product_id' => $id,
            'platform_id' => $platform[0]->id
          );
          $this->db->insert('platform_products',$platformData);
        }
        $this->db->where('id',$id);
        return $this->db->update('products',$data);
      }
    }
    public function createGame(){
      $data=array(
        'title' => str_replace('\'','`',htmlentities($this->input->post('name'))),
  			'description' => htmlentities($this->input->post('desc')),
  			'trailer_video' 	=> htmlentities($this->input->post('trailer')),
  			'price' => htmlentities($this->input->post('price')),
      );
      $error=false;
      if($_FILES['image1']['name']==''){
        $this->session->set_flashdata('noimage','No Image was uploaded.');
        $error=true;
      } else{
        if(sizeof($this->input->post('categories'))==0){
          $this->session->set_flashdata('noCategories','No categories were uploaded.');
          $error=true;
        }
        if(sizeof($this->input->post('platforms'))==0){
          $this->session->set_flashdata('noPlatforms','No platforms were uploaded.');
          $error=true;
        }
        $image=$_FILES['image1']['name'];
        $allowedexts=array('png','jpg','jpeg');
        $ext= strtolower(substr($image,strrpos($image,'.')+1));
        if(in_array($ext,$allowedexts) === false ){
          $this->session->set_flashdata('badext','The allowed image types are png, jpg and jpeg.');
          $error=true;
        }
        if($error==true) return false;
        $this->db->insert('products',$data);

        $CI=get_instance();
        $id=$this->db->query('SELECT * FROM products p WHERE p.title=\''.$data['title'].'\'')->result();
        foreach($this->input->post('categories') as $category){
          $category=$CI->Product_model->get_category_id($category);
          $categoryData=array(
            'product_id' => $id[0]->id,
            'categories_id' => $category[0]->id
          );
          $this->db->insert('categories_products',$categoryData);
        }
        foreach($this->input->post('platforms') as $platform){
          $platform=$CI->Product_model->get_platform_id($platform);
          $platformData=array(
            'product_id' => $id[0]->id,
            'platform_id' => $platform[0]->id
          );
          $this->db->insert('platform_products',$platformData);
        }
        $data['id']=$id[0]->id;
        $data['gameImagePath']='assets/images/game'.$id[0]->id.'.'.$ext;
        $this->db->where('id',$id[0]->id);
        $this->db->update('products',$data);
        move_uploaded_file($_FILES['image1']['tmp_name'],'assets/images/game'.$id[0]->id.'.'.$ext);
        return true;
      }

    }
    public function get_orders(){
      return $this->db->query('SELECT p.title,u.username,o.transaction_id,o.qty,o.price,o.adress,o.adress2,o.city,o.state,o.zipcode from products p,users u,orders o WHERE o.product_id=p.id AND o.user_id=u.id')->result();;
    }
    public function get_all_reported_threads(){
      return $this->db->query('SELECT COUNT(*) AS num_report,(SELECT users.username FROM users WHERE t.user_id=users.id) AS username,(SELECT products.title FROM products WHERE t.product_id=products.id) AS products,t.id,t.user_id,t.title,t.`desc` FROM threads t,thread_reports tr WHERE t.id=tr.thread_id GROUP BY t.id  HAVING num_report > 9')->result();
    }
    public function resetRep($id){
      return $this->db->where('thread_id',$id)->delete('thread_reports');
    }
    public function deleteThread($id){
      return $this->db->where('id',$id)->delete('threads');
    }
    public function delbanThread($id,$userid){
      $this->db->where('id',$id)->delete('threads');
      $this->db->where('id',$userid)->update('users',array('banned' => 'Y'));
    }
  }
?>
