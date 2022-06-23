<section>
	<h2>Categories</h2>
	<table class="table">
      <p><?php echo anchor('admin/category/save', 'Add a new category')?><p>
	  <?php echo alert_message($this->session->flashdata('error')) ?>
	  <?php echo success_message($this->session->flashdata('success')) ?>
	  <p><?php echo $this->session->flashdata('success') ?></p>
	  <thead>
		<tr>
		  <th scope="col">name</th>
		  <th scope="col">Slug</th>
		  <th scope="col">Order</th>
		  <th scope="col">Parent name</th>
		  <th scope="col">Template</th>
		  <th scope="col">Control</th>
		</tr>
	  </thead> 
	  
	  <tbody>
	  <?php if(!empty($categories)) 
	  {
	      foreach($categories as $category)
	      {
	  ?>
		<tr>
		  <td><?= @$category->name?> </td>
		  <td><?= @$category->slug?></td>
		  <td><?= @$category->order?></td>
		  <td><?= @$category->parent_name?></td>
		  <td><?= @$category->template?></td>
		  <td>
		    <?php echo  btn_edit('admin/category/save/'.$category->id);?> |
			<?php  echo btn_delete('admin/category/delete/'.$category->id);?>|
			<a href="<?= site_url('admin/category/change_category/'.$category->id)?>">Change shows reference</a>
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