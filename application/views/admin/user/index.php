<section>
	<h2>Users</h2>
	<table class="table">
      <p><?php echo anchor('admin/user/save', 'Add a new user')?><p>
	  <?php echo alert_message($this->session->flashdata('error')) ?>
	  <?php echo success_message($this->session->flashdata('success')) ?>
	  <thead>
		<tr>
		  <th scope="col">First name</th>
		  <th scope="col">Last name</th>
		  <th scope="col">Email</th>
		  <th scope="col">Control</th>
		</tr>
	  </thead>
	  
	  <tbody>
	  <?php if(!empty($users)) 
	  {
	      foreach($users as $user)
	      {
	  ?>
		<tr>
		  <td><?= @$user->first_name?> </td>
		  <td><?= @$user->last_name?> </td>
		  <td><?= @$user->email?></td>
		  <td>
		    <?php echo  btn_edit('admin/user/save/'.$user->id);?> |
			<?php  echo btn_delete('admin/user/delete/'.$user->id);?>
		  </td>
		</tr>
	  <?php
	     }
	  } else {
	  ?>
	  <tr><td colspan="2" >There is no data to show</td></tr>
	  <?php
	   }
	  ?>

	  </tbody>
	</table>
    <div>
		<?php echo $pagination?>
	</div>
</section>