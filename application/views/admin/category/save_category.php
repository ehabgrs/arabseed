<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($category->id) ? 'Add a new category' : 'Edit category ' . $category->name; ?></h5>
    
</div>

<div class="modal-body">
    <p><?php echo $this->session->flashdata('error') ?></p>
   <?= validation_errors() ?>
    
   <?= form_open() ?>
   
   
      <div class="mb-3">
        <label for="parent_category" class="form-label">Parent</label>
		<!-- form_dropdown(name, options , selected , extra data) -->
		<?php echo form_dropdown('parent_id', $parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $category->parent_id , 'class="form-control" ' );?>
      </div>
	  
    
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= set_value('name',$category->name)?>" id="name">
      </div>
	  
	  <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="<?= set_value('slug',$category->slug)?>" id="slug">
      </div>
	  <div class="mb-3">
        <label class="form-label">Template</label>
		<!-- form_dropdown(name, options , selected , extra data) -->
		<?php echo form_dropdown('template', $template_array , $this->input->post('template') ? $this->input->post('template') : $category->template , 'class="form-control" ' );?>
      </div>

      <input type="submit" name="submit" class="btn btn-primary">
    
   <?= form_close() ?>
				
</div>