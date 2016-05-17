<?php
  function get_categories_h(){
    $CI = get_instance();
    return $CI->Helper_model->get_categories();
  }

  function get_platforms_h(){
    $CI = get_instance();
    return $CI->Helper_model->get_platforms();
  }

  function get_popular_h(){
    $CI = get_instance();
    $popular= $CI->Product_model->get_popular();
    return $popular;
  }
  function get_game_categories_h($id){
    $CI = get_instance();
    $categoryname=$CI->Product_model->get_categoryname($id);
    return $categoryname;
  }
  function get_rating_user($id,$user_id){
    $CI = get_instance();
    $categoryname=$CI->Product_model->get_rating_user($id,$user_id);
    return $categoryname;
  }
  function time_since($since) {
    $now=time();
    $difference=$now-$since;
    if($difference<60) return '1 minute ago';
    else if($difference<3600) return ''.floor($difference/60).' minutes ago';
    else if($difference<86400) return ''.floor($difference/3600).' hours ago';
    else if($difference<604800) return ''.floor($difference/86400).' days ago';
    else if($difference<2419200) return ''.floor($difference/604800).' weeks ago';
    else if($difference<72576000) return ''.floor($difference/2419200).' months ago';
    else if($difference>72576000) return ''.floor($difference/72576000).' years ago';
  }
?>
