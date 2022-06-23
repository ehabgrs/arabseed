<div class="modal-header">
    <h5 class="modal-title">Log in</h5>
    
</div>

<div class="modal-body">  
    <p>Please log in</p>
    <p><?php echo $this->session->flashdata('error') ?></p>
   <?= validation_errors() ?>
   <?= form_open() ?>
    
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email">
      </div>
    
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
 
      <input type="submit" name="submit" class="btn btn-primary">
    
   <?= form_close() ?>
				
</div>