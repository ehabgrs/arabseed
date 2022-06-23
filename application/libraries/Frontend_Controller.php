<?php

class Frontend_Controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_m');
		$this->data['menu'] = $this->category_m->get_nested();
		$this->load->library('pagination');
		$this->data['meta_title'] = config_item('site_name');
	}
	
	
	
	public function initialize_pagination($count,$per_page)
	{
		//check if it the homepage 
		if(is_numeric($this->uri->segment(1)) || $this->uri->segment(1) == ''){
			$config['base_url'] = site_url();
			$config['uri_segment'] = 1;
			$offset = $this->show_m->filter_id_from_get($this->uri->segment(1));
		}else {
			$config['base_url'] = site_url($this->uri->segment(1).'/');
			$config['uri_segment'] = 2;
			$offset = $this->show_m->filter_id_from_get($this->uri->segment(2));
		}
		$config['total_rows'] = $count;
		$config['per_page'] = $per_page;

		$config = array_merge($config, pagination_links_config()) ;
		
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$offset = $offset ? $offset : 0 ;
		return $offset;
	}
	
	public function check_pagination_segment($count, $slug)
	{
		if(is_numeric($this->uri->segment(1)) || $this->uri->segment(1) == ''){
			$pagination_segment = $this->uri->segment(1);
		} else {
			$pagination_segment = $this->uri->segment(2);
		}
		
		if($pagination_segment > ($count - 1) || $pagination_segment < 0) {
			redirect($slug);
		}
	}
}