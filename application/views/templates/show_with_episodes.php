<div class="card mb-3 border-0">
  <img style="height:20rem" src="<?= image_link(json_decode($show->image)->image)?>" class="card-img-top" alt="<?= json_decode($show->image)->alt?>" title="<?= json_decode($show->image)->title?>">
  <div class="card-body">
    <h4 class="card-title"><?= $show->name?></h5>
    <p class="card-text"><?= $show->description?></p>
	<p class="card-text">Release date: <?= $show->release_date?></p>
	<p class="card-text">Rating: <?= $show->rating?></p>
	<p class="card-text">tags: <?= $show->tags?></p>

    <p class="card-text"><small class="text-muted">Publish date: <?= $show->pubdate?> </small></p>
  </div>
  
  <div>
     <h5>Episodes</h5>
	 <div class="row row-cols-1 row-cols-md-4 g-4">
	    <?php foreach($episodes as $episode) :?>
		
		<div class="col card border-0" >
		<a href="<?= episode_link($episode) ?>">
		  <img class="card-img-top" style="height:200px" src="<?= image_link(json_decode($episode->show_image)->image)?>" alt="Card image cap"> 
		</a>
		  <div class="card-body border border-secondary">
            <h5 class="card-title"><?= $episode->show_name?></h5>
			<p class="card-text"></p>
			<p class="card-text">  <?= $episode->episode_number_literally?></p>
			<p class="card-text"><small class="text-muted">Publish date: <?= $show->pubdate?> </small></p>
		  </div>
	    </div>
		
        <?php endforeach?>
	 </div> 
	   
  </div>

