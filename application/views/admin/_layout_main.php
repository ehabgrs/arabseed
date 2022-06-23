<?php $this->load->view('admin/components/header')?>
  <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-light">
              <div class="container-fluid">
                <a class="navbar-brand" href="<?= @ base_url('admin/category')?>"><?= @config_item('site_name') ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="<?= @ base_url('admin/dashboard')?>" > Dashboard</a>
                    </li>

                     <li class="nav-item">
                      <a class="nav-link" href="<?= @ base_url('admin/user')?>" >Users</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="<?= @ base_url('admin/category')?>" >Categories</a>
                    </li>

                    <li class="nav-item">
                        <?php echo anchor('admin/category/order' , 'Order Categories' , 'class = "nav-link"');?>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="<?= @ base_url('admin/country')?>" >Countries</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?= @ base_url('admin/language')?>" >Languages</a>
                    </li>

                     <li class="nav-item">
                        <?php echo anchor('admin/show' , 'All shows' , 'class = "nav-link"');?>
                    </li>
                    <li class="nav-item">
                        <?php echo anchor('admin/episode' , 'Shows with episodes' , 'class = "nav-link"');?>
                    </li>

                  </ul>
                </div>
              </div>
            </nav>
        </div>
	    <div class="container">
			<div class="row">
			  <!-- main column -->
			  <div class="col-sm-9">
				<?php $this->load->view($subview)?> 
			  </div>
			  <!-- sidebar -->
			  <div class="col-sm-3">
				<section>
					<?php echo 'Hello '. $this->session->userdata('first_name') ?>
					<?php echo anchor('admin/user/logout', 'logout')?>
				</section>
				
			  </div>
			</div>
	    </div>
	
  <?php $this->load->view('admin/components/footer')?>