 <?php $this->load->view('admin/components/header')?>
  <body style="background-color:gray">
	<div class="container">
		
		<div class="modal d-block" tabindex="1">
		  <div class="modal-dialog">
			<div class="modal-content">
              <?php $this->load->view($subview); //subview is set in the controller?>  
			  
                
			  <div class="modal-footer">
				<p><?php echo $site_name?><p>
			  </div>
                
			</div>
		  </div>
		</div>

		
	</div>

 <?php $this->load->view('admin/components/footer')?>