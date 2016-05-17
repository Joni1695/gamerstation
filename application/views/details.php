<div class="content">
      <div class="movie_top">
            <div class="col-md-12 movie_box">
                   <div class="grid images_3_of_2">
                     <div class="movie_image">
                           <span class="movie_rating"><?php if($product[0]->rating!==null) echo number_format((float)$product[0]->rating, 2, '.', ''); else echo "No"; ?></span>
                           <img src="<?php echo base_url().$product[0]->gameImagePath; ?>" class="img-responsive" alt=""/>
                       </div>
                       <div class="movie_rate">
                         <div class="rating_desc"><?php if($this->session->userdata('username')) :?>
                           <p>Your Vote :</p>
                         </div>
                         <form class="sky-form">
                          <fieldset>
                          <section>
                            <div class="rating">
                           <input form="myform" type="radio" name="stars-rating" id="stars-rating-5" value="5">
                           <label for="stars-rating-5"><i class="icon-star"></i></label>
                           <input form="myform" type="radio" name="stars-rating" id="stars-rating-4" value="4">
                           <label for="stars-rating-4"><i class="icon-star"></i></label>
                           <input form="myform" type="radio" name="stars-rating" id="stars-rating-3" value="3">
                           <label for="stars-rating-3"><i class="icon-star"></i></label>
                           <input form="myform" type="radio" name="stars-rating" id="stars-rating-2" value="2">
                           <label for="stars-rating-2"><i class="icon-star"></i></label>
                           <input form="myform" type="radio" name="stars-rating" id="stars-rating-1" value="1">
                           <label for="stars-rating-1"><i class="icon-star"></i></label>
                          </div>
                         </section>
                         </fieldset>
                        </form>
                          <div class="clearfix"> </div>
            <?php else :?>
              <p>You have to be logged in to rate.</p><div class="clearfix"> </div></div>
            <?php endif; ?>
             </div>
           </div>
                   <div class="desc1 span_3_of_2">
                     <p class="movie_option"><strong>Title: </strong><?php echo $product[0]->title; ?></p>
                     <p class="movie_option"><strong>Category: </strong><?php for($i=0;$i<sizeof($categories);$i++):?><a href="kari"><?php echo $categories[$i]->categories_id; if($i!=sizeof($categories)-1) echo ','; ?></a><?php endfor; ?></p>

                     <p class="movie_option"><strong>Platform: </strong><?php for($i=0;$i<sizeof($platforms);$i++):?><a href="kari"><?php echo $platforms[$i]->platform_id; if($i!=sizeof($platforms)-1) echo ','; ?></a><?php endfor; ?></p>
                     <p class="movie_option"><strong>Release date: </strong><?php echo $product[0]->created_at; ?></p>
                     <p class="movie_option"><strong>Price: </strong><a href="#">$<?php echo number_format((float)$product[0]->price, 2, '.', ''); ?></a></p>
                     <p class="m_4"><?php echo $product[0]->description; ?></p>
                     <form action="<?php echo base_url();?>cart/add" method="POST">
                       <div class="">
                         QTY: <input type="text" name="qty" value="1">
                         <input name="item_number" type="hidden" value="<?php echo $product[0]->id;?>"/>
                         <input name="title" type="hidden" value="<?php echo $product[0]->title;?>"/>
                         <input name="price" type="hidden" value="<?php echo $product[0]->price;?>"/>
                       </div>
                       <button class="down_btn specialbutton" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add to Cart</button>
                     </form>
                    </div>
                   <div class="clearfix"> </div><hr class="ourhr" style="margin:50px 0 50px 0;">

                   <h2>Write Review</h2>
                   <?php if($this->session->userdata('username')): ?>
               <form method="post" id="myform" action="<?php echo base_url().'postReview/'.$product[0]->id; ?>">
                 <div class="text">
                    <textarea name="text-message"></textarea>
                 </div>
                 <div class="form-submit1">
                   <input type="submit" id="submitbutton" value="Submit Your Message"><br>
                 </div>
                 <div class="clearfix"></div>
               </form>
             <?php else: ?>
               <p> You have to be logged in to review the game.</p>
             <?php endif; ?>
               <div class="single">
               <h1><?php echo sizeof($reviews); ?> User Reviews</h1>
               <ul class="single_list">
            <?php if(sizeof($reviews)==0) echo '<p> No reviews made yet.</p>'; else foreach($reviews as $r) :?>
            <?php $rating=get_rating_user($product[0]->id,$r->id);?>
             <li>
                 <div class="preview"><i class="fa fa-user fa-4x" style="color:#107c10; border:2px solid gray; padding:10px; border-radius:5px;" aria-hidden="true"></i></div>
                 <div class="data">
                     <div class="title"><?php echo $r->username; ?></div>
                     <div class="title">Rating: <span class="<?php if($rating[0]->rating>=4) echo 'green';
                      else if($rating[0]->rating<4 && $rating[0]->rating>2) echo 'yellow';
                      else echo 'red';
                      ?>"><?php echo $rating[0]->rating;?></span></div>

                   <p><?php echo $r->text; ?></p>
                 </div>
                 <div class="clearfix"></div>
             </li>
            <?php endforeach; ?>
         </ul>
                 </div>
                 </div>
                 <div class="col-md-3">

                 </div>
                 <div class="clearfix"> </div>
             </div>
      </div>
</div>
<script type="text/javascript">
$('input[name=stars-rating]').change(function(){
  $.post('<?php echo base_url(); ?>/rateGame',{rating: $(this).val(),game_id: <?php echo $product[0]->id; ?>},function(data){

  },'json');
});
<?php if(isset($myrating) && $myrating!=null): ?>
  $('input[name=stars-rating]').filter('[value='+Math.floor(<?php echo $myrating[0]->rating; ?>)+']').prop('checked',true);
<?php endif; ?>
$('#myform').submit(function(e){
  var error='';
  if($('textarea[name=text-message]').val().trim()=='') error='Review Text needs to be non empty. ';
  if($('input[name=stars-rating]').is(':checked')==false) error+='You need to provide a rating with your review.';
  if(error=='') return;
  else{
    alert(error);
    e.preventDefault();
  }
});
</script>
