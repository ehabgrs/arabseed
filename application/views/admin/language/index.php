<section>
	<h2>Languages</h2>
	<table class="table">
      <p><?php echo anchor('admin/language/save', 'Add a new language')?><p>
	  <?php echo alert_message($this->session->flashdata('error')) ?>
	  <?php echo success_message($this->session->flashdata('success')) ?>
	  <thead>
		<tr>
		  <th scope="col">name</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($languages)) 
	  {
	      foreach($languages as  $language)
	      {
	  ?>
		<tr>
		  <td><?= @$language->name?> </td>
		  <td>
		    <?php echo  btn_edit('admin/language/save/'.$language->id);?> |
			<?php  echo btn_delete('admin/language/delete/'.$language->id);?>
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