<div class="card mb-3 border-0">
  <img style="height:20rem" src="<?= image_link(json_decode($show->image)->image)?>" class="card-img-top" alt="<?= json_decode($show->image)->alt?>" title="<?= json_decode($show->image)->title?>">
  <div class="card-body">
    <h4 class="card-title"><?= $show->name?></h5>
    <p class="card-text"><?= $show->description?></p>
	<p class="card-text">Release date: <?= $show->release_date?></p>
	<p class="card-text">Rating: <?= $show->rating?></p>
	<p class="card-text">tags: <?= $show->tags?></p>
	<div>
	   <h5>Streaming links</h5>
	   <?php foreach(json_decode($show->streaming_links) as $name => $stream_link) :?>
	   <p> <a href=" <?= $stream_link?> " > <?= remove_link_name_suffix($name) ?> </a></p>
	   <?php endforeach?>
	</div>
	
	<div>
	   <h5>download links</h5>
	   <?php foreach(json_decode($show->download_links) as $name => $download_link) :?>
	   <p> <a href=" <?= $download_link?> " > <?= remove_link_name_suffix($name) ?> </a></p>
	   <?php endforeach?>
	</div>
	
    <p class="card-text"><small class="text-muted">Publish date: <?= $show->pubdate?> </small></p>
  </div>
</div>
