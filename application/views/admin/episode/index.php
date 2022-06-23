<section>
    <h3>List of all shows have episodes</h3>
	<?php echo alert_message($this->session->flashdata('error')) ?>
	<?php echo success_message($this->session->flashdata('success')) ?>
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">name</th>
		  <th scope="col">View</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($shows)) : foreach($shows as $show):  ?>
		<tr>
		  <td><?= @$show->name?> </td>
		  <td>
		    <?php echo  anchor('admin/episode/show/'.$show->id, 'View episodes');?> |
            <?php echo  anchor('admin/episode/save/'.$show->id, 'Add new episodes');?>
		  </td>
		</tr>
	  <?php
	   endforeach; else :
	  ?>
	  <tr><td colspan="2" >There is no data to show</td></tr>
	  <?php
	   endif
	  ?>

	  </tbody>
	</table>
    <div>
		<?php echo $pagination?>
	</div>
</section>