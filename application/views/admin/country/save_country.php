<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($country->id) ? 'Add a new country' : 'Edit country ' . $country->name; ?></h5>
    
</div>

<div class="modal-body">
    <p><?php echo $this->session->flashdata('error') ?></p>
   <?= validation_errors() ?>
    
   <?= form_open() ?>
   
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?= set_value('name',$country->name)?>" id="name">
      </div>

      <input type="submit" name="submit" class="btn btn-primary">
    
   <?= form_close() ?>
				
</div>