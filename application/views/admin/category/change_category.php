<section>
    
	<div class='mt-2'><?php echo alert_message($this->session->flashdata('error')) ?></div>
	<?php echo success_message($this->session->flashdata('success')) ?>
	<h3>Change shows category from <?= $category->name?> to another category</h3>
	
    <?= form_open() ?>
    <div class="mb-3">
        <label for="new_category_id" class="form-label">Change to</label>
		<!-- form_dropdown(name, options , selected , extra data) -->
		<?php echo form_dropdown('new_category_id', $categories, $this->input->post('new_category_id') , 'class="form-control" ' );?>
		<input type="submit" name="submit" class="btn btn-primary">
    </div>	
	
</section>