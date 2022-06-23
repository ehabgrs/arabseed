<section>
    <h3><?= $page->name?></h3>
 
	<div class="row row-cols-1 row-cols-md-4 g-4">
	  <?php foreach($shows as $show): ?>
	  <div class="col card border-0">
		  <a href="<?= show_link($show) ?>">
			<img class="card-img-top" style="height:200px" src="<?= site_url('front/images/'.json_decode($show->image)->image)?>" alt="Card image cap"> 
		  </a>  
		  <div class="card-body border border-light">
			<p class="card-text"><?= $show->name?></p>
			<p class="card-text">  <?= $show->description?></p>
		  </div>
	  </div>
	  <?php endforeach?>
	</div>  
	<div>
		<?php echo$pagination?>
	</div>
</section>