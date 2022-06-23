<div class="modal-header">
    <h5 class="modal-title"><?php echo empty($user->id) ? 'Add a new user' : 'Edit user ' . $user->first_name. ' ' . $user->last_name; ?></h5>
    
</div>
<div class="modal-body">
    <p><?php echo $this->session->flashdata('error') ?></p>
	
   <?= validation_errors() ?>
   <?= form_open() ?>
    
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= set_value('email',$user->email)?>" id="email">
      </div>
	  
	  <div class="mb-3">
        <label for="first_name" class="form-label">First name</label>
        <input type="text" name="first_name" class="form-control" value="<?= set_value('first_name',$user->first_name)?>" id="first_name">
      </div>
	  
	  <div class="mb-3">
        <label for="last_name" class="form-label">last name</label>
        <input type="text" name="last_name" class="form-control" value="<?= set_value('last_name',$user->last_name)?>" id="last_name">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
	  
	   <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm">
      </div>
 
      <input type="submit" name="submit" class="btn btn-primary">
    
   <?= form_close() ?>
				
</div>