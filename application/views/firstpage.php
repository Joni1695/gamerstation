<div class="slider">
<div class="callbacks_container">
<ul class="rslides" id="slider">
  <?php foreach($first as $f) :?>
  <li><img src="<?php echo base_url().$f->gameImagePath; ?>" class="img-responsive" alt=""/>
    <div class="button">
    <a href="#" class="hvr-shutter-out-horizontal">Buy Now</a>
  </div>
  </li>
<?php endforeach; ?>
</ul>
</div>
</div>
<?php if($this->session->flashdata('registered')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('registered'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('successpurchase')) : ?>
<div class="alert alert-success">
  <?php echo $this->session->flashdata('successpurchase'); ?>
</div>
<?php endif; ?>
<div class="clearfix">
</div>
<div class="content">
  <div class="box_1">
   <h1 class="m_2">Latest Releases</h1>
   <div class="search">
  <form>
  <input type="text" id="autocomplete" placeholder="Search...">
  <input type="submit" value="">
  </form>
</div>
<div class="clearfix"> </div>
</div>
<div class="box_2">
<hr class="ourhr">
<?php foreach($products as $p) :?>
  <a href="<?php echo base_url().'details/'.$p->id;?>">
<div class="col-md-3 game">
  <img class="game-img" src="<?php echo base_url().$p->gameImagePath; ?>">
  <span class="movie_rating_first"><?php if($p->rating!==null) echo number_format((float)$p->rating, 2, '.', ''); else echo "No"; ?></span>
  <div class="price"><span class="price-text">Price </span><span class="game-price"> $<?php echo $p->price; ?></span></div>
  <div class="game-footer">
    <?php echo $p->title; ?>
  </div>
</div>
</a>
<?php endforeach; ?>
<div class="clearfix"> </div>
<br><br><br>
</div>
</div>
<script type="text/javascript">
  var gamearray=[
    <?php foreach($autocomplete as $a): ?>
    {
      value:"<?php echo $a->id;?>",
      label:"<?php echo $a->title; ?>"
    },
    <?php endforeach; ?>
  ];
  $('#autocomplete').autocomplete({
    source : gamearray,
    select : function(event,ui){
      document.location.href="<?php echo base_url(); ?>"+"details/"+ui.item.value;
    }
  });
</script>
