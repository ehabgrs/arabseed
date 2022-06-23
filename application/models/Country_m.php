<?php

class Country_m extends MY_Model
{
    protected $_table_name = 'countries';
	protected $_order_by = 'id';
	public    $rules = array(  
	
	    'name' => array(
             'field' => 'name',
             'label' => 'Country name',
             'rules' => 'trim|required|max_length[100]'
         )
    );
	
	protected $_reference_in_shows_table = 'country_id';
	
	public function get_new()
	{
		$country = new stdClass();
		$country->name = '';
		return $country;
	}
    
    
    
    
    public function delete($id)
    {
        if($this->has_references_to_shows_table($id) === FALSE){
            
           parent::delete($id); 
            
        }

    }
    
    
    
}
