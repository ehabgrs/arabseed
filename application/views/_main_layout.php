<?php $this->load->view('components/page_header'); ?>

<body>
    <div class="container">
        <h3><?= anchor( '' , strtoupper(config_item('site_name')), 'class="text-decoration-none link-dark"' ) ?></h3>
		
        <nav class="navbar navbar-expand-lg bg-light">
		
              <div class="container-fluid">
			  
                <a class="navbar-brand" href="<?= site_url()?>"><?= @config_item('site_name') ?></a>
				
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
				
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					      <li class="nav-item"> <a class="nav-link"  aria-current="page" href="<?=site_url('/')?>" > Homepage </a> </li>
					      <?php
						   //get_menu() finction we created at cms_helper file locate in helper folder
						   // $menu we sent it inside frontend controller class, with the data , containing the nested data
						   echo get_menu($menu);
						   ?>

                      </ul>
                </div>
				
              </div>
			  
        </nav>
		
	</div>
    
	<div class="container">
		<div class="row">
			<?php $this->load->view('templates/' . $subview);?>
		</div>
	</div>
	
<script>
    // to can make dropdown parent links working and open dropdown with hover
	jQuery(function($) {
	$('.navbar .dropdown').hover(function() {
	$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

	}, function() {
	$(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

	});

	$('.navbar .dropdown > a').click(function(){
	location.href = this.href;
	});

	});
</script>

<?php $this->load->view('components/page_footer'); ?>