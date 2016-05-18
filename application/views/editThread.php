<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<div class="content">
  <form action="" method="post">
    <?php echo echocsrf_html();?>
    <div class="col-md-6">
      <label for="title">Title:</label> <input type="text" id="title" name="title" value="<?php echo $thread[0]->title;?>">
    </div>
    <div class="col-md-6">
      <label for="desc">Description: </label> <textarea id="desc" name="desc" rows="8" cols="40"><?php echo $thread[0]->desc;?></textarea>
    </div>
    <div class="col-md-12 ">
      <hr>
      <input type="submit" class="btn btn-default btn-success center-block" value="Edit">
    </div>
  </form>
  <div class="clearfix">

  </div>
</div>
