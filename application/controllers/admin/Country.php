<?php

class Country extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('country_m');
	}
	
	public function index()
	{
		$count = $this->db->count_all_results('countries');
		
		$offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
		$this->data['countries'] = $this->country_m->get();
		
        $this->data['subview'] = 'admin/country/index';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    public function save($id = NULL)
    {
		$id = validate_int($id);
 
        if_extra_segment_redirect(5,'admin/country/save/'.$id);
        
        if($id == NULL) {
            $this->data['country'] = $this->country_m->get_new();
        }else {
           $result = $this->country_m->get($id);
           $result || redirect('admin/country/save');
           $this->data['country'] = $result;
        }
		
        $rules = $this->country_m->rules;
        
        $this->form_validation->set_rules($rules);
        
        if($this->form_validation->run() == TRUE) {
            
            $data = $this->country_m->array_from_post(array('name'));
            
            $this->country_m->save($data,$id);

            redirect('admin/country');
        }
 
        $this->data['subview'] = 'admin/country/save_country';
        $this->load->view('admin/_layout_main',$this->data);
    
    }
    
    
    public function delete($id)
    {
        $this->country_m->delete($id);
        redirect('admin/country');
    }
    
 
}