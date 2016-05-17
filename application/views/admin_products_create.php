<?php if($this->session->flashdata('createfail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('createfail'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('filefail')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('filefail'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('badext')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('badext'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('noimage')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('noimage'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('noCategories')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('noCategories'); ?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('noPlatforms')) : ?>
<div class="alert alert-danger">
  <?php echo $this->session->flashdata('noPlatforms'); ?>
</div>
<?php endif; ?>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<div class="col-md-12">
  <form id="formaime" action="<?php echo base_url(); ?>adminpanel/createGame" enctype="multipart/form-data" method="post">
  <div class="col-md-6">
    <div class="form-block">
      <label for="game_name">Game Name:</label>
      <input type="text" id="game_name" name="name" value="">
    </div>
    <br><br>
    <div class="form-block">
      <label for="game_trailer">Game Trailer:</label>
      <input type="text" id="game_trailer" name="trailer" value="">
    </div>
    <br><br>
    <div class="form-block">
      <label for="game_price">Game Price:</label>
      <input type="text" id="game_price" name="price" value="">
    </div>
    <br><br>
    <div class="form-block">
      <label for="game_image1">Game Image:</label>
      <input type="file" id="game_image1" name="image1">
    </div>
    <br>
  </div>
  <div class="col-md-6">
    <label for="game_desc">Game Description:</label><br>
    <textarea name="desc" id="game_desc" rows="8" cols="40"></textarea>
    <br><br>
    <label for="categories">Select Categories</label>
    <select multiple="" name="categories[]" id="categories_product" form="formaime" class="form-control">
        <?php foreach(get_categories_h() as $category): ?>
        <option><?php echo $category->name; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="categories">Select Platforms</label>
    <select multiple="" name="platforms[]" id="platforms_product" form="formaime" class="form-control">
      <?php foreach(get_platforms_h() as $platform): ?>
      <option><?php echo $platform->name; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" name="create_game" class="btn btn-default btn-success create_game" value="notempty">Create</button>
  </form>
</div>
</div>
</body>
</html>
