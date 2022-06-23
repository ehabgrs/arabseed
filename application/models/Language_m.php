<?php

class Language_m extends MY_Model
{
    protected $_table_name = 'languages';
	protected $_order_by = 'id';
	public    $rules = array(  
	
	    'name' => array(
             'field' => 'name',
             'label' => 'Language',
             'rules' => 'trim|required|max_length[100]'
         )
    );
	protected $_reference_in_shows_table = 'language_id';
	
	public function get_new()
	{
		$language = new stdClass();
		$language->name = '';
		return $language;
	}
    
    
    
    
   public function delete($id)
    {
        if($this->has_references_to_shows_table($id) === FALSE){
            
           parent::delete($id); 
            
        }

    }
  
}
