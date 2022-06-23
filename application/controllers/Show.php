<?php

class Show extends Frontend_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('show_m');
		$this->load->model('episode_m');
    }
    
    public function index($id = NULL, $name = NULL)
    {
		$id = validate_int($id);
		$name = validate_url_name($name);
		
        //fetch the data
        $this->db->where('pubdate <= ' , date('Y-m-d'));
        $this->data['show'] = $this->show_m->get($id);
        //if article not found return 404
        $this->data['show'] || redirect();
        
        //redirect the page for the right name if the user tried to change it
        //to not duplicate the url for google indexing for example
		//urldecode return the value to the orginal decoded value as if the name in arabic will turn to unicode characters in the url
        $requested_name = urldecode($this->uri->segment(3));
		
		//url_title will fill the spaces in the name with - and make it valid url
        $show_name = url_title($this->data['show']->name);
		
        if($requested_name != $show_name ) {
            redirect('show/'.$this->data['show']->id.'/'.url_title($this->data['show']->name) , 'location', '301');
        }
            
        
        //load the view
	    //add_meta_title($string) function in cms_helper to set the page meta title 
		//add_meta_title($this->data['article']->title);
		
		if($this->data['show']->has_episodes == 1)
		{
			$this->data['episodes']= $this->episode_m->get_episodes_for_show($id);
			$this->data['subview'] = 'show_with_episodes';
			
		} else {
			
			$this->data['subview'] = 'show';
			
		}
		
        
        $this->load->view('_main_layout', $this->data);
        
    }
}