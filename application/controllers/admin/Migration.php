<?php

class Migration extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->library('migration');
		//current() will check the migration version setting inside migration file 
		// then for example if 1 , will  will run the file start with 001 inside the migration folder
		//call the function and check if didn't work will give error 
		
		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		} else {
			echo 'migration worked';
		}
	}
}