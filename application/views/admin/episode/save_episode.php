<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($episode->id) ? 'Add a new episode to ' . $show->name : 'Edit episode ' . $episode->episode_number_literally ." ". $show->name; ?></h5>
</div>

<div class="modal-body">

   <?php echo alert_message($this->session->flashdata('error')) ?>
   <?php echo success_message($this->session->flashdata('success')) ?>
   <?= validation_errors() ?>
    
   <?= form_open_multipart('','',array('show_id' => $show->id)) ?>
   
   
   <div class="row"> 
      <div class="mb-3 col-md-4">
        <label for="episode_number" class="form-label">Episode Number</label>
        <input type="number" name="episode_number" class="form-control" value="<?= set_value('episode_number',$episode->episode_number)?>" id="episode_number">
      </div>
      <div class="mb-3 col-md-8">
        <label for="episode_number_literally" class="form-label">Episode Number literally</label>
        <input type="text" name="episode_number_literally" class="form-control" value="<?= set_value('episode_number_literally',$episode->episode_number_literally)?>" id="episode_number_literally">
      </div>
   </div>
 
    
   <div class="row">
      <div class="mb-3 col-md-4">
        <label for="label" class="form-label">Label</label>
        <input type="text" name="label" class="form-control" value="<?= set_value('label',$episode->label)?>" id="description">
      </div>
     
   </div> 
        
    
   <div  class="row">
	   <p class="mb-1">Streaming links</p>
        
	    <?php $streaming_links = isset($streaming_links) ? $streaming_links : $episode->streaming_links ; foreach($streaming_links as $name => $value):?>
        
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
        
	  <?php $download_links = isset($download_links) ? $download_links : $episode->download_links ; foreach($download_links as $name => $value):?>
	   
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
    
  
	
	<div class="mb-3 mt-3 col-md-4">
        <label for="pubdate" class="form-label">publication date</label>
		<?php echo form_input(array('name' => 'pubdate', 'type' => 'date'), set_value('pubdate',$episode->pubdate), array('class' => 'form-control') );?>
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