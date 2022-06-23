<?php //var_dump($show->streaming_links)?>
<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($show->id) ? 'Add a new show' : 'Edit show ' . $show->name; ?></h5>
</div>

<div class="modal-body">

   <p><?php echo $this->session->flashdata('error') ?></p>
   <?= validation_errors() ?>
    
   <?= form_open_multipart() ?>
   
   <div class="row">
      <div class="mb-3 col-md-4">
        <label for="category_id" class="form-label">Category</label>
		<!-- form_dropdown(name, options , selected , extra data) -->
		<?php echo form_dropdown('category_id', $categories, set_value('category_id',$show->category_id) , 'class="form-control" ' );?>
      </div>
      
       <div class="mb-3 col-md-4">
        <label for="country_id" class="form-label">Country</label>
		<?php echo form_dropdown('country_id', $countries, set_value('country_id',$show->country_id), 'class="form-control" ' );?>
      </div>
    
      <div class="mb-3 col-md-4">
        <label for="language_id" class="form-label">Language</label>
		<?php echo form_dropdown('language_id', $languages, set_value('language_id',$show->language_id) , 'class="form-control" ' );?>
      </div>
   </div>
   
   <div class="row"> 
      <div class="mb-3 col-md-8">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= set_value('name',$show->name)?>" id="name">
      </div>
      <div class="mb-3 col-md-4">
        <label for="has_episodes" class="form-label">Has episodes?</label>
		<?php echo form_dropdown('has_episodes', array(0=>'No',1 => 'Yes'), set_value('has_episodes',$show->has_episodes), 'class="form-control" ' );?>
      </div>
   </div>
    
   <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" value="<?= set_value('description',$show->description)?>" id="description">
   </div>
    
   <div class="row">
      <div class="mb-3 col-md-4">
        <label for="label" class="form-label">Label</label>
        <input type="text" name="label" class="form-control" value="<?= set_value('label',$show->label)?>" id="description">
      </div>
    
      <div class="mb-3 col-md-4">
        <label for="release_date" class="form-label">Release date</label>
		<?php echo form_input(array('name' => 'release_date', 'type' => 'date'), set_value('release_date',$show->release_date), array('class' => 'form-control') );?>
      </div>
    
      <div class="mb-3 col-md-4">
        <label for="rating" class="form-label">Rating</label>
		<?php echo form_input(array('name' => 'rating', 'type' => 'number'), set_value('rating',$show->rating), array('step' => 0.01 , 'max' => 9.99 , 'min' => 0, 'class' => 'form-control'));?>
      </div>   
   </div> 
    
   <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
		<?php echo form_input('tags', set_value('tags',$show->tags) , array('class' => 'form-control'));?>
   </div>
        
    
   <div  class="row">
	   <p class="mb-1">Streaming links</p>
        
	    <?php $streaming_links = isset($streaming_links) ? $streaming_links : $show->streaming_links ; foreach($streaming_links as $name => $value):?>
        
	   <div class="row stream" >
		  <div class="form-group col-md-4">
		   <label>Server name</label>
		   <input type="text" name="streaming_names[]" value="<?= remove_link_name_suffix($name)?>" class="form-control">
		  </div>

		  <div class="form-group col-md-8">
			<label>Link</label>
			<input type="text" name="streaming_links[]" value="<?= $value?>" class="form-control">
		  </div>
	   </div>
        
       <?php endforeach?>
        
	   <div class="stream_add"></div>
	   
	   <div class="form-group mt-1 col-md-2">
			  <button class="btn btn-primary add_stream">Add</button>
	   </div>
    </div>
    
    <div class="row">
	   <p class="mt-4 mb-1">Downloading links</p>
        
	  <?php $download_links = isset($download_links) ? $download_links : $show->download_links ; foreach($download_links as $name => $value):?>
	   
        <div class="row download" >
		  <div class="form-group col-md-4">
		   <label>Server name</label>
		   <input type="text" name="download_names[]" value="<?= remove_link_name_suffix($name)?>" class="form-control">
		  </div>

		  <div class="form-group col-md-8">
			<label>Link</label>
			<input type="text" name="download_links[]" value="<?= $value?>" class="form-control">
		  </div>
	   </div>
        
        <?php endforeach?>
        
	   <div class="download_add"></div>
	   
	   <div class="form-group mt-1 col-md-2">
			  <button class="btn btn-primary add_download">Add</button>
	   </div>
    </div>
    
   
	<div class="row mt-3">
		<div class="mb-3  col-md-4">
			<label  class="form-label">Image</label>
			<input type="file" name="userfile" class="form-control"/>
			<img src="<?= base_url('/front/images/'. $show->image->image)?>" style="width:30px;height:30px">
		</div>
		<div class="mb-3 col-md-4">
			<label for="alt" class="form-label">Alt</label>
			<input type="text" name="alt" class="form-control" value="<?= set_value('alt',$show->image->alt)?>" id="alt">
        </div>
		<div class="mb-3 col-md-4">
			<label for="title" class="form-label">Title</label>
			<input type="text" name="title" class="form-control" value="<?= set_value('title',$show->image->title)?>" id="title">
        </div>
	</div>
	
	<div class="mb-3 mt-3 col-md-4">
        <label for="pubdate" class="form-label">publication date</label>
		<?php echo form_input(array('name' => 'pubdate', 'type' => 'date'), set_value('pubdate',$show->pubdate), array('class' => 'form-control') );?>
    </div>
	
       
	<br>
    
	<input type="submit" name="submit" class="mb-4 btn btn-primary">
    
   <?= form_close() ?>
				
</div>

<script type="text/javascript">
$(document).ready(function(){
        $('.add_stream').click(function(){
            var cl = $('.stream').first('.stream').clone(true);
            //added this part to not clone the value of the input
            cl.find("input[type='text']").val("");
            $('.stream_add').append(cl);
            return false;

        });
    
        $('.add_download').click(function(){
            var cl = $('.download').first('.download').clone(true);
            cl.find("input[type='text']").val("");
            $('.download_add').append(cl);
            return false;

        });
});
</script>