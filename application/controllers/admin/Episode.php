<?php

class Episode extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('episode_m');
		$this->load->model('show_m');
	}
	
	public function index()
	{
        if_extra_segment_redirect(4,'admin/episode');
        
		$count = count( (array) $this->show_m->get_by(array('has_episodes' => 1)) );
		
        $offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
        $this->data['shows'] = $this->show_m->get_by(array('has_episodes' => 1));
        
        $this->data['subview'] = 'admin/episode/index';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    public function show($id = NULL){
         
        $id = validate_int($id);
        
        $show = $this->show_m->get_by(array('has_episodes' => 1 , 'id' => $id));
        
        ($id && $show) || redirect('admin/episode');

        if_extra_segment_redirect(5,'admin/episode/show/'.$id);
        
        $this->data['show'] = $this->show_m->get_with_references_details($id);
        
        $this->data['episodes'] = $this->episode_m->get_by(array('show_id' => $id));
        
        $this->data['subview'] = 'admin/episode/show';
        $this->load->view('admin/_layout_main',$this->data);
    }
    
    public function save($show_id = NULL , $id = NULL)
    {
        $show_id = validate_int($show_id);
        
        $id = validate_int($id);
        
        if_extra_segment_redirect(6,'admin/episode/save/'.$show_id.'/'.$id);
        
        ($show_id && count($this->show_m->get_shows_have_episodes($show_id))) || redirect('admin/episode');
        
        $this->db->select('id,name');
        $this->data['show'] = $this->show_m->get($show_id);

        //set the values for the form
        if($id == NULL) {

            $this->data['episode'] = $this->episode_m->get_new();

        } else {

            $result = $this->episode_m->get($id);
            
            ($id && $result) ||  redirect('admin/episode/save/'.$show_id);

            $result->streaming_links = $result->streaming_links ? json_decode($result->streaming_links) : json_decode('{"":""}');
            $result->download_links = $result->download_links ? json_decode($result->download_links) : json_decode('{"":""}');

            $this->data['episode'] = $result;

        }
     
        //validate and submit the form
        $rules = $this->episode_m->rules;
  
        $this->form_validation->set_rules($rules);
        
        if($this->form_validation->run() == TRUE) {
            
           
            $data = $this->episode_m->array_from_post(array(
                'show_id',
                'episode_number',
                'episode_number_literally',
                'label',
                'pubdate'
            ));
			
			
            $data['streaming_links'] = $this->episode_m->handle_links( $this->input->post('streaming_names') , $this->input->post('streaming_links') );
            //to keep the data that we wrote, if the form has error and the page got refreshed
            $this->data['streaming_links'] = json_decode($data['streaming_links']);
            
            $data['download_links'] = $this->episode_m->handle_links( $this->input->post('download_names') , $this->input->post('download_links') );
            
            $this->data['download_links'] = json_decode($data['download_links']);
			
			$this->episode_m->save($data,$id);

            redirect('admin/episode/show/'.$show_id);
        }
 
        $this->data['subview'] = 'admin/episode/save_episode';
        $this->load->view('admin/_layout_main',$this->data);
    
    }
    
    
    public function delete($id = NULL, $show_id = NULL)
    {
		$id = validate_int($id);
		$show_id = validate_int($show_id);
        $this->episode_m->delete($id);
        redirect('admin/episode/show/'.$show_id);
    }
    
    
    
}