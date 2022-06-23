<?php

class Page extends Frontend_Controller {
	
	const PER_PAGE = 3;
	const HOMEPAGE_TEMPLATE = 'main';
	const HOMEPAGE_SLUG = '/';
    
    public function __construct()
    {
        parent::__construct(); 
		$this->load->model('episode_m');
		
    }
    
    
    public function index()
    { 
        $segment = $this->uri->segment(1);
		//set the page by the slug and if empty will be home page
		//!is_numeric($segment) to avoid the pagination number
        if($segment && !is_numeric($segment)) {
			$this->data['page'] = $this->category_m->get_by(array('slug' => $segment), TRUE );
		} else {
			$this->data['page'] = (object) array('slug' => self::HOMEPAGE_SLUG , 'template' => self::HOMEPAGE_TEMPLATE );
		}

		//check if the slug given for the url already has a page not a random slug
		//if not a real page slug , so we will give error
		$this->data['page'] || redirect();
		
		//function in cms_helper to set the page meta title 
		//add_meta_title($this->data['page']->title);
		
		//get the template value from the page array and add _
		$page_template = '_'. $this->data['page']->template;
		
		// call the action method for the name of the template of the page
		//check first that method exists
		if(method_exists($this, $page_template)){
			$this->$page_template($this->data['page']);
		} else {
			log_message('error' , 'Could not load template '. $page_template . 'in file ' . __FILE__ . 'at line ' . __LINE__);
			show_error('Couldn\'t load template ' . $page_template);
		}
		
		//will call the subview in the template name and then will load it inside the main_layout view
		//will create views for every template inside folder templates in views folder
		$this->data['subview'] = $this->data['page']->template;
        $this->load->view('_main_layout', $this->data);
		
    }
	
	public function _category($page)
	{
		$count = count( (array) $this->show_m->get_by(array('category_id' => $page->id)) );
		$this->check_pagination_segment($count, $page->slug);
		
		if($count > self::PER_PAGE) {
			$offset = $this->initialize_pagination($count, self::PER_PAGE);
		} else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
		
		$this->db->limit(self::PER_PAGE,$offset);
		$this->data['shows'] = $this->show_m->get_by(array('category_id' => $page->id));
	}
	
	public function _s_category($page)
	{
		$count = count( (array) $this->episode_m->get_episodes_for_category($page->id) );
		$this->check_pagination_segment($count, $page->slug);
		
		if($count > self::PER_PAGE) {
			
			$offset = $this->initialize_pagination($count, self::PER_PAGE);
			
		} else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
		
		$this->data['episodes'] = $this->episode_m->get_episodes_for_category($page->id,self::PER_PAGE, $offset);
	}
	
	public function _main($page)
	{
        $this->db->limit(8);
		$this->data['shows_no_episodes'] = $this->show_m->shows_no_episodes();
        
        $this->db->limit(8);
        $this->data['all_episodes'] = $this->episode_m->get_all_episodes();
        
		$count = count( (array)$this->show_m->get_all_shows_and_episodes() );
		
		$this->check_pagination_segment($count, $page->slug);
		
		if($count > self::PER_PAGE) {
			
			$offset = $this->initialize_pagination($count, self::PER_PAGE);
			
		} else {
			$this->data['pagination'] = '';
			$offset = 0;
		}

		$this->data['pagination_segment'] = $this->uri->segment(1);
        $this->data['all_results'] = $this->show_m->get_all_shows_and_episodes(self::PER_PAGE, $offset);
		
	} 
	
	public function _p_category($page)
	{
        $count = count((array) $this->show_m->get_shows_by_parent_category($page->id) );
		
		$this->check_pagination_segment($count, $page->slug);
	
		if($count > self::PER_PAGE) {
			
			$offset = $this->initialize_pagination($count, self::PER_PAGE);
			
		} else {
			$this->data['pagination'] = '';
			$offset = 0;
		}

		$this->data['shows'] = $this->show_m->get_shows_by_parent_category($page->id, self::PER_PAGE, $offset);
        
	}

}