<?php

class Language extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('language_m');
	}
	
	public function index()
	{   
        $count = $this->db->count_all_results('languages');
		
		$offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
		$this->data['languages'] = $this->language_m->get();
        
        $this->data['subview'] = 'admin/language/index';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    public function save($id = NULL)
    {
        $id = validate_int($id);
        
        if_extra_segment_redirect(5,'admin/language/save/'.$id);
        
        //set the values for the form
        if($id == NULL) {
            $this->data['language'] = $this->language_m->get_new();
        }else {
           $result = $this->language_m->get($id);
           $result || redirect('admin/language/save');
           $this->data['language'] = $result;
        }
        
        //set the rules and save the inputs
        $rules = $this->language_m->rules;
        
        $this->form_validation->set_rules($rules);
        
        if($this->form_validation->run() == TRUE) {
            
            $data = $this->language_m->array_from_post(array('name'));
            
            $this->language_m->save($data,$id);
            
            redirect('admin/language');
        }
 
        $this->data['subview'] = 'admin/language/save_language';
        $this->load->view('admin/_layout_main',$this->data);
    
    }
    
    
    public function delete($id)
    {
        $this->language_m->delete($id);
        redirect('admin/language'); 
    }
    
    
    
    
}