<?php

class Episode extends Frontend_Controller
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
		
        $this->db->where('episodes.pubdate <= ' , date('Y-m-d'));
	   
        $this->data['episode'] = $this->episode_m->get_episode_with_show($id);
	   
	    $this->data['episode'] || redirect();
	   
	    $this->data['show'] = $this->show_m->get($this->data['episode']->show_id);
	   
	    $episode = $this->data['episode'];
	    $show = $this->data['show'];

        $requested_name = urldecode($this->uri->segment(3));
		
        $episode_name = url_title($show->name.'-'.$episode->episode_number_literally);
		
        
        if($requested_name != $episode_name ) {
            redirect('episode/'.$episode->id.'/'.$episode_name, 'location', '301');
        }
		
        $this->db->where('episodes.id !=', $id); 
		$this->data['episodes_same_show'] = $this->episode_m->get_episodes_for_show($show->id);
		
        $this->data['subview'] = 'episode';
        $this->load->view('_main_layout', $this->data);
        
    }
}