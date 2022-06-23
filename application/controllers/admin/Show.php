<?php

class Show extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('show_m');
        $this->load->model('category_m');
        $this->load->model('country_m');
        $this->load->model('language_m');
	}
	
	public function index()
	{
        $count = $this->db->count_all_results('shows');
		
		$offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
		$this->data['shows'] = $this->show_m->get_with_references_details();
        
        $this->data['subview'] = 'admin/show/index';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    public function save($id = NULL)
    {
		$id = validate_int($id);
        
        if_extra_segment_redirect(5,'admin/language/save/'.$id);
        
        //set the values for the form
        if($id == NULL) {
           $result = $this->data['show'] = $this->show_m->get_new();
        }else {
           $result = $this->show_m->get($id);
           $result || redirect('admin/show/save');
		   
           $result->image = $result->image  ? json_decode($result->image) : json_decode('{"image":"","alt":"","title":""}');
		   $result->streaming_links = $result->streaming_links ? json_decode($result->streaming_links) : json_decode('{"":""}');
		   $result->download_links = $result->download_links ? json_decode($result->download_links) : json_decode('{"":""}');
			
		   $this->data['show'] = $result;
        }
		
	    //set the values for the dropdowns
        $this->data['categories'] = $this->category_m->get_for_dropdown();
        $this->data['countries'] = $this->country_m->get_for_dropdown();
        $this->data['languages'] = $this->language_m->get_for_dropdown();
        
		//rules and save
        $rules = $this->show_m->rules;
  
        $this->form_validation->set_rules($rules);
		
		if ($id == NULL && empty($_FILES['userfile']['name'])) {
			$this->form_validation->set_rules('userfile', 'Image', 'required');
		}
        
        if($this->form_validation->run() == TRUE) {
            
           
            $data = $this->show_m->array_from_post(array(
                'category_id',
                'language_id',
                'country_id',
                'has_episodes',
                'name',
                'description',
                'label',
                'release_date',
                'tags',
                'rating',
                'pubdate'
            ));
			
			//handle the json data
            $data['streaming_links'] = $this->show_m->handle_links( $this->input->post('streaming_names') , $this->input->post('streaming_links') );
            
            $this->data['streaming_links'] = json_decode($data['streaming_links']);
            
            $data['download_links'] = $this->show_m->handle_links( $this->input->post('download_names') , $this->input->post('download_links') );
            
            $this->data['download_links'] = json_decode($data['download_links']);
			
			//handle the image upload
			if(isset($_FILES) && $_FILES["userfile"]['name'] !== '') {
			
				//defined in the heleper
				$config = image_common_config();
				
				$file_name = $_FILES["userfile"]['name'];
				$config['file_name'] = crypt_file_name($file_name);
				
				$this->load->library('upload',$config);
			
				//if the file is successfully uploaded
				if ($this->upload->do_upload('userfile')) {
					
					//if edit delete the old image
					if($id && $result->image->image !== '' && file_exists('./front/images/'.$result->image->image)){
						unlink_file($result->image->image);
					} 
					
					//add the image data for the data
					$image_name = $this->upload->data('file_name');
					$data['image'] = $this->show_m->handle_image($image_name, $this->input->post('alt'), $this->input->post('title'));
					
					//save the show
					if($this->show_m->save($data,$id)) {
                         redirect('admin/show');
                    }
			
				} else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
				}
				
			} else {
				
				if($this->show_m->save($data,$id)){
                    redirect('admin/show');
                }
                
			}
     
        }
 
        $this->data['subview'] = 'admin/show/save_show';
        $this->load->view('admin/_layout_main',$this->data);
    
    }
    
    
    public function delete($id)
    {
        $this->show_m->delete($id);
        redirect('admin/show');
    }
    
    public function test()
    {
        $array_1 = array(0 => 'server' , 1 => 'server', 2 => '');
        $array_2 = array(0 => 'link1', 1 => '', 3 => 'link3');
        $json = json_encode(array_combine($array_1,$array_2));
        $json_ = json_decode($json);
        // var_dump($this->show_m->handle_links_names($array_1));
		 
	   //var_dump($this->show_m->handle_links($array_1,$array_2));
	   //$name = 'ehab_gghghgh.jpg';
	   //echo $this->set_file_name($name);
	   echo base_url('/front/images');
    }
    
    
}