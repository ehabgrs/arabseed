<section>
    <h3>Latest shows</h3>
	<div class="row row-cols-1 row-cols-md-4 g-4">
	  <?php foreach($shows_no_episodes as $show): ?>
		<div class="col card border-0" >
	      <a href="<?= show_link($show) ?>">
			<img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($show->image)->image)?>" alt="Card image cap"> 
		  </a>  
		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $show->name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $show->category_name?></p>
		  </div>
		</div>
	  <?php endforeach?>
	</div>  
</section>

<section>
    <h3>Latest episodes</h3>
	<div class="row row-cols-1 row-cols-md-4 g-4">
	  <?php foreach($all_episodes as $episode): ?>
		<div class="col card border-0" >
	      <a href="<?= episode_link($episode) ?>">
			 <img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($episode->show_image)->image)?>" alt="Card image cap"> 
		  </a> 
		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $episode->show_name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $episode->episode_number_literally?></p>
		  </div>
		</div>
      <?php endforeach?>
	</div>  
</section>

<section id="all_shows">
    <h3>All shows and episodes</h3>
	<div class="row row-cols-1 row-cols-md-4 g-4">
        
	  <?php
        foreach($all_results as $result){ 
        if(isset($result->episode_number)){
      ?>
		<div class="col card border-0" >
		  <a href="<?= episode_link($result) ?>">
			<img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($result->show_image)->image)?>" alt="Card image cap"> 
		  </a> 		 
		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $result->show_name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $result->episode_number_literally?></p>
		  </div>
		</div>
        
        <?php }else{ ?>
        
        <div class="col card border-0" >
		  <a href="<?= show_link($result) ?>">
			<img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($result->image)->image)?>" alt="Card image cap"> 
		  </a>  		  
		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $result->name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $result->category_name?></p>
		  </div>
		</div>
        
      <?php } } ?>
        
	</div>  
	<div>
		<?php echo $pagination?>
	</div>
</section>

<script>
<?php if($pagination_segment) : ?>
$(document).ready(function () {
   
    $('html, body').animate({
        scrollTop: $('#all_shows').offset().top
    });
});
<?php endif?>
</script>
 
