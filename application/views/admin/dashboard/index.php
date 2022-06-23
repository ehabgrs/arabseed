<section>
    <h3>Dashboard</h3>
	<div class="row row-cols-1 row-cols-md-2 g-4">
	
	  <div class="col">
		<div class="card border-info">
		  <h5 class="card-header">Users</h5>
		  <div class="card-body">
			<p class="card-text"> <a href="<?= site_url('admin/user')?>" class="btn btn-primary">Show users</a></p>
			<p class="card-text">  <a href="<?= site_url('admin/user/save')?>" class="btn btn-primary">Add a new user</a></p>
		  </div>
		</div>
	  </div>
	  
	  <div class="col">
		<div class="card border-info">
		  <h5 class="card-header">Shows</h5>
		  <div class="card-body">
			<p class="card-text"> <a href="<?= site_url('admin/show')?>" class="btn btn-primary">All shows</a> <a href="<?= site_url('admin/show/save')?>" class="btn btn-primary">Add a new show</a></p>
			<p class="card-text"> <a href="<?= site_url('admin/episode')?>" class="btn btn-primary">Shows have episodes</a></p>
		  </div>
		</div>
	  </div>
	  
	  <div class="col">
		<div class="card border-info">
		  <h5 class="card-header">Categories</h5>
		  <div class="card-body">
			<p class="card-text">
			   <a href="<?= site_url('admin/category')?>" class="btn btn-primary">All categories</a>
			   <a href="<?= site_url('admin/category/save')?>" class="btn btn-primary">Add a new Category</a>
			</p>
			<p class="card-text"><a href="<?= site_url('admin/category/order')?>" class="btn btn-primary">Order categories</a></p>
		  </div>
		</div>
	  </div>
	  
	  <div class="col">
		<div class="card border-info">
		  <h5 class="card-header">Languages</h5>
		  <div class="card-body">
			<p class="card-text"> <a href="<?= site_url('admin/language')?>" class="btn btn-primary">All languages</a> </p>
			<p><a href="<?= site_url('admin/language/save')?>" class="btn btn-primary">Add a new language</a></p>
		  </div>
		</div>
	  </div>
	  
	  <div class="col">
		<div class="card border-info">
		  <h5 class="card-header">Countries</h5>
		  <div class="card-body">
			<p class="card-text"> <a href="<?= site_url('admin/country')?>" class="btn btn-primary">All countries</a> </p>
			<p><a href="<?= site_url('admin/country/save')?>" class="btn btn-primary">Add a new country</a></p>
		  </div>
		</div>
	  </div>
	</div>  
</section>