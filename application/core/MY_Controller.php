<?php

class MY_controller extends CI_Controller
{
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->data['errors'] = array();
	}
	
}