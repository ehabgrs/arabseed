<section>
    <h3><?=$show->name?></h3>
	<?php echo alert_message($this->session->flashdata('error')) ?>
	<?php echo success_message($this->session->flashdata('success')) ?>
	<table class="table">
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
	  <?php if(!empty($show)) 
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
	  } else {
	  ?>
	  <tr><td colspan="2" >There is no data to show</td></tr>
	  <?php
	   }
	  ?>

	  </tbody>
	</table>

	<h3>Episodes</h3>
	<table class="table">
      <p><?php echo anchor('admin/episode/save/'.$show->id , 'Add a new episode')?><p>
	  <thead>
		<tr>
		  <th scope="col">Number</th>
		  <th scope="col">Literally</th>
		  <th scope="col">Control</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($episodes)) 
	  {
	      foreach($episodes as $episode)
	      {
	  ?>
		<tr>
		  <td><?= @$episode->episode_number?> </td>
		  <td><?= @$episode->episode_number_literally?></td>
		  <td>
		    <?php echo  btn_edit('admin/episode/save/'. $show->id . '/'. $episode->id);?> |
			<?php  echo btn_delete('admin/episode/delete/'.$episode->id.'/'.$show->id);?>
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
</section>