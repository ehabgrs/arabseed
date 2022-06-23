<?php

class MY_Model extends CI_Model
{
		protected $_table_name = '';
		protected $_primary_key = 'id';
		//the default name column inside the table
        protected $_column_name = 'name';
		protected $_primary_filter = 'intval';
		protected $_order_by = '';
		public    $rules = array();
		protected $_timestamps = FALSE;
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('show_m');
	}
	

	
	public function get($id = NULL, $single = FALSE) {
		if($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		} elseif($single == true) {
			$method = 'row';
		} else {
			$method = 'result';
		}
		
		$this->db->order_by($this->_order_by);
		return $this->db->get($this->_table_name)->$method();
	}


	public function get_by($where, $single = FALSE)
	{
		$this->db->where($where);
		return $this->get(NULL,$single);
	}
	
	
	public function save($data , $id = NULL)
	{
		if($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		//insert
		if($id == NULL) {
			//if the user set a value for it, we set it for null, as it auto_increment
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			
			$this->db->set($data);
			if($this->db->insert($this->_table_name)){
				$id = $this->db->insert_id();
				$this->session->set_flashdata('success', 'The item has been added successfully');
			}
			
		} //update
		else {
            
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			if($this->db->update($this->_table_name)){
				$this->session->set_flashdata('success', 'The item has been updated successfully');
			}
		}
		return $id;
	}
	
	
	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if(!$id) {
			return false;
		}
		
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		if($this->db->delete($this->_table_name)){
			$this->session->set_flashdata('success', 'The item has been deleted successfully');
		}
	}
    
	
	public function array_from_post($fields)
	{
		$data = array();
        
		foreach($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
    
    // get the value and the name of the table for dropdown for the form
    public function get_for_dropdown($results = NULL)
    {
        $value = $this->_primary_key;
        
        $name =  $this->_column_name;
		
        if($results == NULL) {
			$this->db->select($value.','. $name);
            $results = $this->get();
		}
        
        $array = array('' => 'Select');

        foreach($results as  $result) {

            $array[$result->$value] = $result->$name;

        }

        return $array;
      
    }
	
	//check if there is shows references for it in the shows table
	
	public function has_references_to_shows_table($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if(!$id) {
			return false;
		}
		$items = $this->show_m->get_by(array($this->_reference_in_shows_table => $id));
		 if($items) {
			$this->session->set_flashdata('error', 'Sorry you can\'t delete this item, you have to delete all the references for it first, at  shows table or change the reference for another');
            return true;			
        } else {
			return false;
		}
	}
	
	
	
	//functions to handle the provided links array from the form 
	public function handle_links_names($array)
	{
		$array_names = array();
		
		foreach($array as $key => $name) {
			$name = $name ?  $name : 'server';
			$array_names[$key] = $name . '__' . ($key + 1);
		}
		
		return $array_names;
	}
	
	
	public function handle_links($array_names, $array_links)
	{
		$array_names = $this->handle_links_names($array_names);
		
		$results = array_combine($array_names,$array_links);
		
		$array = array();
		
		foreach($results as $name => $link) {
			if ($link == '') {
				continue;
			}
			
			$array[$name] = $link;
		}
        //to fix the disappear of the straming or downlod form field if the form submit has error and the user was leaving those fieds empty before submit
		$array = $array ? $array : array('' => '');
        
		return json_encode($array);
	}
	
   
	
	public function handle_image($image, $alt, $title)
	{
		return json_encode(array('image' => $image,'alt' => $alt , 'title' => $title));
	}
	
	//TODO TO CHANGE TO validate_int() function in the helper 
	public function filter_id_from_get($id)
    {
		$filter = $this->_primary_filter;
	    return $filter($id);
	}
    
	
	
   

	
	
}