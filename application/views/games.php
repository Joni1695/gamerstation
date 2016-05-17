<div class="content">
 <h2 class="m_3">All Games</h1>
   <div class="dropdown inlinedrp">
     <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
     <label>Categories: <?php echo $category; ?></label>
     </button>
     <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
       <li class="hovearble" ><a class="categories" data-id="">All</a></li>
       <?php foreach(get_categories_h() as $category) :?>
       <li class="hovearble" ><a class="categories" data-id="<?php echo $category->id;?>"><?php echo $category->name; ?></a></li>
       <?php endforeach; ?>
     </ul>
   </div>
   <div class="dropdown inlinedrp">
     <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
     <label>Platforms: <?php echo $platform; ?></label>
     </button>
     <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
       <li class="hovearble" ><a class="platforms" data-id="">All</a></li>
       <?php foreach(get_platforms_h() as $category) :?>
       <li class="hovearble" ><a class="platforms" data-id="<?php echo $category->id;?>"><?php echo $category->name; ?></a></li>
       <?php endforeach; ?>
     </ul>
   </div>
   <div class="dropdown inlinedrp">
     <button class="btn btn-default dropdown-toggle nothing" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
     <label>Sort: <?php if($sorts==0) echo 'by date'; else if($sorts==1) echo 'by name'; else if($sorts==2) echo 'by price'; else echo 'by date';?></label>
     </button>
     <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
       <li class="hovearble" ><a class="sorts" data-id="0">by date</a></li>
       <li class="hovearble" ><a class="sorts" data-id="1">by name</a></li>
       <li class="hovearble" ><a class="sorts" data-id="2">by price</a></li>
     </ul>
   </div>
   <input type="text" class="pull-right searchable" placeholder="<?php if($st=='') echo 'Search...'; else echo $st;?>" value="">
   <hr class="ourhr">
   <?php $i=0; ?>
   <?php foreach($products as $p): ?>
  <a href="<?php echo base_url().'details/'.$p->id;?>">
   <div class="col-md-3 game">
     <img class="game-img" src="<?php echo base_url().$p->gameImagePath; ?>">
     <span class="movie_rating_first"><?php if($ratings[$i][0]->rating!==null) echo number_format((float)$ratings[$i][0]->rating, 2, '.', ''); else echo "No"; ?></span>
     <div class="price"><span class="price-text">Price </span><span class="game-price"> $<?php echo $p->price; ?></span></div>
     <div class="game-footer">
       <?php echo $p->title; ?>
     </div>
   </div>
 </a>
   <?php $i++; ?>
 <?php endforeach; ?>
 <hr class="col-md-12 ourhr">
  <div class="col-md-12" style="text-align:center;"><?php echo $links; ?></div>
  <div class="clearfix"> </div>
  <br><br><br>

</div>
<script type="text/javascript">
  $(document).ready(function(){
    var url=window.location.href;
    $('.categories').click(function(){
      var string='category='+$(this).data('id');
      url=url.replace(/category=([0-9]*)/ig,string)
      document.location.href=url;
    });
    $('.platforms').click(function(){
      var string='platform='+$(this).data('id');
      url=url.replace(/platform=([0-9]*)/ig,string)
      document.location.href=url;
    });
    $('.sorts').click(function(){
      var string='order='+$(this).data('id');
      url=url.replace(/order=([0-9]*)/ig,string)
      document.location.href=url;
    });
    $('.searchable').change(function(){
      var string='searchterm='+$(this).val().replace(' ','%20');
      url=url.replace(/searchterm=([a-zA-Z0-9%_\-]*)/ig,string)
      document.location.href=url;
    });
  });
</script>
