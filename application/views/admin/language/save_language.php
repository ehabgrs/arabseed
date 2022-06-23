<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($language->id) ? 'Add a new language' : 'Edit language ' . $language->name; ?></h5>
    
</div>

<div class="modal-body">
    <p><?php echo $this->session->flashdata('error') ?></p>
   <?= validation_errors() ?>
    
   <?= form_open() ?>
   
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= set_value('name',$language->name)?>" id="name">
      </div>

      <input type="submit" name="submit" class="btn btn-primary">
    
   <?= form_close() ?>
				
</div>