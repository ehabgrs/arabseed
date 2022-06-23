<?php

class Admin_Controller extends MY_Controller
{
	const PER_PAGE = 3;
	
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
		
		$this->load->model('user_m');
		$this->load->library('pagination');
		
		$this->data['meta_title'] = 'Admin_'. config_item('site_name');
		
		$exception_uris = array (
			'admin/user/login',
			'admin/user/logout'
		);
		
		if(in_array(uri_string() , $exception_uris) == FALSE) {
			$this->user_m->is_logged_in() == True || redirect('admin/user/login');
		}
	
	}
	
	
	private function initialize_pagination($count)
	{
		$config['base_url'] = site_url('admin/'.$this->uri->segment(2));
		$config['uri_segment'] = 3;
		$offset = $this->show_m->filter_id_from_get($this->uri->segment(3));
		$config['total_rows'] = $count;
		$config['per_page'] = self::PER_PAGE;
		$config = array_merge($config, pagination_links_config()) ;
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$offset = $offset ? $offset : 0 ;
		return $offset;
	}
	
    //if pagination segment less than zero or higher than the count
    //return for the first page of pagination
	private function check_pagination_segment($count)
	{
		if($this->uri->segment(3) > ($count - 1) || $this->uri->segment(3) < 0) {
			redirect('admin/'.$this->uri->segment(2));
		}
	}
    
    //check if count > per page we set the pagination
    private function check_if_need_pagination($count)
    {
        if($count > self::PER_PAGE) {
			$offset = $this->initialize_pagination($count, self::PER_PAGE);
		} else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
        return $offset;
    }
    
    
    public function set_pagination($count)
    {
        $this->check_pagination_segment($count);
        $offset = $this->check_if_need_pagination($count);
        return $offset;
    }
}