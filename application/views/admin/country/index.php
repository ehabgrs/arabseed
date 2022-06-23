<section>
	<h2>Countries</h2>
	<table class="table">
      <p><?php echo anchor('admin/country/save', 'Add a new country')?><p>
	  <?php echo alert_message($this->session->flashdata('error')) ?>
	  <?php echo success_message($this->session->flashdata('success')) ?>
	  <thead>
		<tr>
		  <th scope="col">name</th>
		  <th scope="col">Control</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($countries)) 
	  {
	      foreach($countries as $country)
	      {
	  ?>
		<tr>
		  <td><?= @$country->name?> </td>
		  <td>
		    <?php echo  btn_edit('admin/country/save/'.$country->id);?> |
			<?php  echo btn_delete('admin/country/delete/'.$country->id);?>
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