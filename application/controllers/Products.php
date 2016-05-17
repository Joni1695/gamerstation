<?php
class Products extends CI_Controller{
  public function mainPage(){
    $first_products=$this->Product_model->get_first_page();
    $products=$this->Product_model->get_first_products();
    $autocomplete=$this->Product_model->get_games_autocomplete();
    $data=array(
      'mainContent' => 'firstpage',
      'first' => $first_products,
      'products' => $products,
      'autocomplete' => $autocomplete
    );
    $this->load->view('main',$data);
  }
  public function details($id){
    $product=$this->Product_model->get_game_data($id);
    $categories=$this->Product_model->get_gamecategories($id);
    foreach($categories as $c) $c->categories_name=$this->Product_model->get_categoryname($c->categories_id);
    $platform=$this->Product_model->get_gameplatforms($id);
    foreach($platform as $c) $c->platform_name=$this->Product_model->get_platformname($c->platform_id);
    $reviews=$this->Product_model->get_reviews($product[0]->id);
    $data=array(
      'mainContent' => 'details',
      'product' => $product,
      'categories' => $categories,
      'platforms' => $platform,
      'reviews' => $reviews
    );
    if($this->session->userdata('username')) $data['myrating']=$this->Product_model->get_personal_rating($product[0]->id);
    $this->load->view('main',$data);
  }
  public function search(){
    if($this->input->get('platform') && $this->input->get('platform')!='') $p=htmlentities($this->input->get('platform'));
    else $p=-1;
    if($this->input->get('category') && $this->input->get('category')!='') $c=htmlentities($this->input->get('category'));
    else $c=-1;
    if($this->input->get('order') && $this->input->get('order')!='') $o=htmlentities($this->input->get('order'));
    else $o=0;
    if($this->input->get('searchterm') && $this->input->get('searchterm')!='') $st=htmlentities($this->input->get('searchterm'));
    else $st='';
    $order=' ';
    if($o == 0){
      $order .='order by products.id DESC';
    }
    else if($o == 1){
      $order .='order by products.title ASC';
    }
    else if($o == 2){
      $order .='order by products.price DESC';
    }

    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		// $config['display_pages'] = FALSE;

		$config['anchor_class'] = 'follow_link';
	  $config['base_url'] = site_url('Products/search/');
		$config['first_url'] = $config['base_url'].'/0?'.http_build_query($_GET);
        //percakton url e pare.tregon edhe faqen 0
		$config['per_page'] = 8;
		$config['uri_segment'] = 3;

    $data['category'] = ($c!=-1 ? $this->Product_model->get_categoryname($c) :'All');
    $data['platform'] = ($p!=-1 ? $this->Product_model->get_platformname($p) :'All');
    $data['sorts']=$o;
    $data['st']=$st;

    if($p==-1 && $c==-1){
      $nr=$this->Product_model->countall($st);
      $config['total_rows'] = $nr;
      $this->load->library('pagination',$config);//behet inicializimi i arrayt
      $data['number'] = $nr;

      $data['products']=$this->Product_model->get_products($config['per_page'],$this->uri->segment(3),$o,$st);
      foreach($data['products'] as $product){
        $data['ratings'][]=$this->Product_model->get_game_ratings($product->id);
      }
      $data['links'] = $this->pagination->create_links();
      $data['mainContent']='games';
      $this->load->view('main',$data);
    }
    else if($p==-1 && $c!=-1){
      $sql='SELECT products.id,products.title,products.gameImagePath,products.created_at,products.price from products,categories_products where products.id=categories_products.product_id and categories_products.categories_id='.' '.$c.' ';
      if($st!=''){
        $st=explode(' ',trim($st,' '));
        for($i=0;$i<sizeof($st);$i++){
          if($i==0) $sql.='AND (products.title LIKE \'%'.$st[$i].'%\'  ';
          else $sql.='OR products.title LIKE \'%'.$st[$i].'%\'  ';
          if($i==sizeof($st)-1) $sql.=')';
        }
      }
      $sql.=$order;
      $count_sql=$sql;
      $sql.=' '.'LIMIT'.' '.$config['per_page'].'  '.'OFFSET'.' '.$this->uri->segment(3);
      $data['products']=$this->Product_model->get_products_by_query($sql);
      foreach($data['products'] as $product){
        $data['ratings'][]=$this->Product_model->get_game_ratings($product->id);
      }
      $nr=$this->Product_model->count_query($count_sql);
      $config['total_rows'] = $nr;
      $this->load->library('pagination',$config);//behet inicializimi i arrayt
      $data['number'] = $nr;
      $data['links'] = $this->pagination->create_links();
      $data['mainContent']='games';
      $this->load->view('main',$data);
    }
    else if($p!=-1 && $c==-1){
      $sql='SELECT products.id,products.title,products.gameImagePath,products.created_at,products.price from products,platform_products where products.id=platform_products.product_id and platform_products.platform_id='.' '.$p.' ';
      if($st!=''){
        $st=explode(' ',trim($st,' '));
        for($i=0;$i<sizeof($st);$i++){
          if($i==0) $sql.='AND (products.title LIKE \'%'.$st[$i].'%\'  ';
          else $sql.='OR products.title LIKE \'%'.$st[$i].'%\'  ';
          if($i==sizeof($st)-1) $sql.=')';
        }
      }
      $sql.=$order;
      $count_sql=$sql;
      $sql.=' '.'LIMIT'.' '.$config['per_page'].'  '.'OFFSET'.' '.$this->uri->segment(3);
      $data['products']=$this->Product_model->get_products_by_query($sql);
      foreach($data['products'] as $product){
        $data['ratings'][]=$this->Product_model->get_game_ratings($product->id);
      }
      $nr=$this->Product_model->count_query($count_sql);
      $config['total_rows'] = $nr;
      $this->load->library('pagination',$config);//behet inicializimi i arrayt
      $data['number'] = $nr;
      $data['links'] = $this->pagination->create_links();
      $data['mainContent']='games';
      $this->load->view('main',$data);
    }
    else{
      $sql='SELECT products.id,products.title,products.gameImagePath,products.created_at,products.price from products,categories_products,platform_products where products.id=platform_products.product_id and platform_products.platform_id='.' '.$p.' '.'and products.id=categories_products.product_id and categories_products.categories_id='.' '.$c.' ';
      if($st!=''){
        $st=explode(' ',trim($st,' '));
        for($i=0;$i<sizeof($st);$i++){
          if($i==0) $sql.='AND (products.title LIKE \'%'.$st[$i].'%\'  ';
          else $sql.='OR products.title LIKE \'%'.$st[$i].'%\'  ';
          if($i==sizeof($st)-1) $sql.=')';
        }
      }
      $sql.=$order;
      $count_sql=$sql;
      $sql.=' '.'LIMIT'.' '.$config['per_page'].'  '.'OFFSET'.' '.$this->uri->segment(3);
      $data['products']=$this->Product_model->get_products_by_query($sql);
      foreach($data['products'] as $product){
        $data['ratings'][]=$this->Product_model->get_game_ratings($product->id);
      }
      $nr=$this->Product_model->count_query($count_sql);
      $config['total_rows'] = $nr;
      $this->load->library('pagination',$config);//behet inicializimi i arrayt
      $data['number'] = $nr;
      $data['links'] = $this->pagination->create_links();
      $data['mainContent']='games';
      $this->load->view('main',$data);
    }
  }
  public function rateGame(){
    if($this->session->userdata('user_id') && $this->input->post('rating') && $this->input->post('game_id')){
      $this->Product_model->rate_Game($this->input->post('rating'),$this->input->post('game_id'));
    } else redirect('main');
  }
  public function postReview($id){
    if($this->session->userdata('username') && $this->input->post('text-message')){
      $this->Product_model->add_review($id,htmlentities($this->input->post('text-message')));
      redirect('details/'.$id);
    } else redirect('main');
  }
  public function forum(){
    $config['suffix'] = '';
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		// $config['display_pages'] = FALSE;

		$config['anchor_class'] = 'follow_link';
	  $config['base_url'] = site_url('Products/forum/');
		$config['first_url'] = $config['base_url'].'/0';
        //percakton url e pare.tregon edhe faqen 0
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
    $nr=$this->Product_model->countall('');
    $config['total_rows'] = $nr;
    $this->load->library('pagination',$config);//behet inicializimi i arrayt
    $data['number'] = $nr;
    $lastthread=array();
    $products=$this->Product_model->get_products($config['per_page'],$this->uri->segment(3),1,'');
    foreach($products as $p){
      $lastthread[]=$this->Product_model->get_last_thread($p->id);
    }
    $recentthreads=$this->Product_model->get_recent_threads();
    $autocomplete=$this->Product_model->get_games_autocomplete();
    $data=array(
      'mainContent' => 'forum',
      'autocomplete' => $autocomplete,
      'products' => $products,
      'threads' => $lastthread,
      'recent' => $recentthreads
    );
    $data['links'] = $this->pagination->create_links();
    $this->load->view('main',$data);
  }
  public function forumGame($id){
    $config['suffix'] = '';
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		// $config['display_pages'] = FALSE;

		$config['anchor_class'] = 'follow_link';
	  $config['base_url'] = site_url('Products/forumgame/');
		$config['first_url'] = $config['base_url'].'/0';
        //percakton url e pare.tregon edhe faqen 0
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
    $gamethreads=$this->Product_model->get_game_threads($id);
    $nr=sizeof($gamethreads);
    $config['total_rows'] = $nr;
    $this->load->library('pagination',$config);//behet inicializimi i arrayt
    $data['number'] = $nr;
    $product=$this->Product_model->get_game_data($id);

    $data=array(
      'mainContent' => 'forumgame',
      'product' => $product,
      'threads' => $gamethreads
    );
    $data['links'] = $this->pagination->create_links();
    $this->load->view('main',$data);
  }
  public function thread($id){
    $thread=$this->Product_model->get_thread($id);
    $data=array(
      'mainContent' => 'thread',
      'threadtitle' => $thread[0]->title,
      'thread' => $thread
    );
    $this->load->view('main',$data);
  }
  public function delThread($id){
    $thread_author=$this->Product_model->get_thread($id);
    if($this->session->userdata('user_id') && ($this->session->userdata('username')==$thread_author[0]->username || $this->session->userdata('status')=='admin')){
      $this->Product_model->removeThread($id);
      redirect('Products/forum');
    }
    else redirect('thread/'.$id);
  }
  public function reportThread(){
    if($this->session->userdata('user_id') && $this->input->post('thread_id')){
      $this->Product_model->reportThread($this->input->post('thread_id'));
    }
  }
  public function editThread($id){
    $thread_author=$this->Product_model->get_thread($id);
    if($this->session->userdata('user_id') && ($this->session->userdata('username')==$thread_author[0]->username || $this->session->userdata('status')=='admin')){
      $this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('desc','Description','trim|required');
      if($this->form_validation->run()==false){
        $data['thread']=$thread_author;
        $data['mainContent']='editThread';
        $this->load->view('main',$data);
      }else{
        $this->Product_model->updateThread($id);
        redirect('thread/'.$id);
      }
    }
    else redirect('thread/'.$id);
  }
  public function createThread(){
    if($this->session->userdata('user_id')) $this->Product_model->createThread();
  }
  public function postFeedback(){
    $data['msg']='Feedback was not successfully added';
    $data['type']='fail';
    if($this->input->post('name') && $this->input->post('contact') && $this->input->post('message')){
      if($this->Feedback_model->add_feedback()) {
        $data['msg']='Feedback was successfully added';
        $data['type']='success';
      }
    }
    echo json_encode($data);
  }
}
 ?>
