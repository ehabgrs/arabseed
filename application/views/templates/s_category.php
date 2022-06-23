<section>
    <h3><?= $page->name?></h3>
	<div class="row row-cols-1 row-cols-md-4 g-4">
	  <?php foreach($episodes as $episode): ?>
		<div class="col card border-0" >
		  <a href="<?= episode_link($episode) ?>">
			 <img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($episode->show_image)->image)?>" alt="Card image cap"> 
		  </a> 		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $episode->show_name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $episode->episode_number_literally?></p>
		  </div>
		</div>
	  <?php endforeach?>
	</div>  
	<div>
		<?php echo $pagination?>
	</div>
</section>