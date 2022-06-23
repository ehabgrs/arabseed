<?php

class Category_m extends MY_Model
{
    protected $_table_name = 'categories';
	protected $_order_by = 'parent_id asc, order';
	public    $rules = array(  
	
	    'parent_id' => array(
             'field' => 'parent_id',
             'label' => 'Parent ID',
             'rules' => 'trim|intval' 
         ),
	    'name' => array(
             'field' => 'name',
             'label' => 'Category name',
             'rules' => 'trim|required|max_length[100]'
         ),
		 'slug' => array(
             'field' => 'slug',
             'label' => 'Slug',
             'rules' => 'trim|required|max_length[100]|url_title'
         ),
		 'template' => array(
             'field' => 'template',
             'label' => 'Template',
             'rules' => 'trim|required'
         )
    
    );
	
	public $template_array = array(
	            'category' => 'Category',
				's_category' => 'Category with episodes',
				'p_category' => 'Parent category'
	);
	
	protected $_reference_in_shows_table = 'category_id';
	
	public function get_new()
	{
		$category = new stdClass();
		$category->name = '';
		$category->slug = '';
        $category->template = '';
		$category->parent_id = 0;
		return $category;
	}
    
    
    public function get_categories_with_no_parents()
    {
        $this->db->select('id,name');
        $this->db->where('parent_id', 0 );
        $categories = parent::get();
        //set the array we will fetch in the dropdown of select parent
        //array as key of id and value of the name
        $array = array(0 => 'No parent');
        if($categories) {
            foreach($categories as $category) {
                $array[$category->id] = $category->name;
            }  
        }
        
        return $array;
    }
    
    
    public function get_with_parent_details($id = NULL, $single = FALSE)
    {
        $this->db->select('categories.* , c.slug as parent_slug, c.name as parent_name');
        $this->db->join('categories as c ' , 'categories.parent_id = c.id' , 'left');
        return parent::get($id,$single);
    }
	
	public function has_childs($id)
	{
		$results = parent::get_by(array('parent_id' => $id));
		
		if($results) {
			$this->session->set_flashdata('error', 'Sorry you can\'t delete this category, it has childs, set the childs to another parent first, from order categories page');
			return TRUE;
		} else {
			return FALSE;
		}
	}	
    
    
    public function delete($id)
    {
        if($this->has_references_to_shows_table($id) === FALSE && $this->has_childs($id) === FALSE){
			 parent::delete($id);
			 return true;
             //$this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table_name);
		} elseif($this->has_references_to_shows_table($id) === TRUE) {
			return 'shows';
		} elseif($this->has_childs($id) === TRUE) {
			return 'childs';
		}
    }
	
    
    public function get_nested()
    {
        $categories = $this->db->order_by($this->_order_by)->get($this->_table_name)->result_array();
        
        $array = array();
        
        foreach($categories as $category) {
            
            if(!$category['parent_id']) {
                
                $array[$category['id']] = $category;
                
            } else {
                $array[$category['parent_id']] ['children'][$category['id']] = $category;
            }
        }
        
        return $array;
    }
    
    
    public function save_ordered_data($categories)
    {
        if($categories){
            foreach($categories as $order => $category){
                if($category['item_id'] != '') {
                    $this->db->set(array('parent_id' => (int) $category['parent_id'], 'order' => $order));
                    $this->db->where($this->_primary_key, $category['item_id']);
                    $this->db->update($this->_table_name);
                }
            }
        
        }
    }
	
	//CHECK FOR LATER IF WE NEED TO ADD FRO DROPDOWN THE CATEGORIES THAT HAS NO CHILDS AND HAS SHOWS DIRECTLY
	public function get_for_dropdown($results = NULL) {
		$this->db->select('id,name');
        $this->db->where('parent_id !=', 0 );
		$results = parent::get();
		return parent::get_for_dropdown($results);
	}
	
	
	
    
  
}
