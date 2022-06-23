<section>
	<h2>Shows</h2>
	<table class="table">
      <p><?php echo anchor('admin/show/save', 'Add a new show')?><p>
	  <?php echo alert_message($this->session->flashdata('error')) ?>
	  <?php echo success_message($this->session->flashdata('success')) ?>
	  <thead>
		<tr>
		  <th scope="col">name</th>
		  <th scope="col">Categoey</th>
		  <th scope="col">language</th>
		  <th scope="col">country</th>
		  <th scope="col">Control</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($shows)) 
	  {
	      foreach($shows as $show)
	      {
	  ?>
		<tr>
		  <td><?= @$show->name?> </td>
		  <td><?= @$show->category_name?></td>
		  <td><?= @$show->language_name?></td>
		  <td><?= @$show->country_name?></td>
		  <td>
		    <?php echo  btn_edit('admin/show/save/'.$show->id);?> |
			<?php  echo btn_delete('admin/show/delete/'.$show->id);?>
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