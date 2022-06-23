<?php

class Show_m extends MY_model
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('episode_m');
        
    }
    
	protected $_table_name = 'shows';
	protected $_order_by = 'id desc'; 
	protected $_timestamps = TRUE;
	public    $rules =  array(
	
	    'category_id' => array(
             'field' => 'category_id',
             'label' => 'Category ID',
             'rules' => 'trim|required|intval' 
         ),
		 'language_id' => array(
             'field' => 'language_id',
             'label' => 'language ID',
             'rules' => 'trim|required|intval' 
         ),
		 'country_id' => array(
             'field' => 'country_id',
             'label' => 'country ID',
             'rules' => 'trim|required|intval' 
         ),
	    'has_episodes' => array(
             'field' => 'has_episodes',
             'label' => 'Has episodes',
             'rules' => 'trim|required'
         ),
		 'name' => array(
             'field' => 'name',
             'label' => 'Name',
             'rules' => 'trim|required|max_length[100]'
         ),
		 'description' => array(
             'field' => 'description',
             'label' => 'Description',
             'rules' => 'trim|required|max_length[400]'
         ),
		 'label' => array(
             'field' => 'label',
             'label' => 'Label',
             'rules' => 'trim|max_length[100]'
         ),
		 'tags' => array(
             'field' => 'tags',
             'label' => 'Tags',
             'rules' => 'trim|max_length[200]'
         ),
		 'release_date' => array(
             'field' => 'release_date',
             'label' => 'Release date',
             'rules' => 'trim|exact_length[10]'
         ),
		 'rating' => array(
             'field' => 'rating',
             'label' => 'Rating',
             'rules' => 'trim|decimal'
         ),
		 'title' => array(
             'field' => 'title',
             'label' => 'Title',
             'rules' => 'required|trim'
         ),
		 'alt' => array(
             'field' => 'alt',
             'label' => 'Alt',
             'rules' => 'required|trim'
         ),
		 'streaming_links[]' => array(
             'field' => 'streaming_links[]',
             'label' => 'Streaming links',
             'rules' => 'max_length[200]'
         ),
		 'streaming_names[]' => array(
             'field' => 'streaming_names[]',
             'label' => 'Streaming names',
             'rules' => 'max_length[30]'
         ),
		 'download_links[]' => array(
             'field' => 'download_links[]',
             'label' => 'Download links',
             'rules' => 'max_length[200]'
         ),
		 'download_names[]' => array(
             'field' => 'download_names[]',
             'label' => 'Download names',
             'rules' => 'max_length[30]'
         ),
        'pubdate' => array(
             'field' => 'pubdate',
             'label' => 'Publication date',
             'rules' => 'trim|required|exact_length[10]'
         )
    );
	
	
    
	public function get_new()
	{
		//stdClass is a php empty class
		$show = new stdClass();
		$show->category_id ='';
		$show->language_id ='';
		$show->country_id ='';
		$show->has_episodes =0;
		$show->name ='';
		$show->slug ='';
		$show->description ='';
		$show->label ='';
		$show->tags ='';
		$show->release_date ='';
		$show->rating ='';
		$show->image = json_decode('{"image" : "", "alt":"", "title":"" }');
		$show->streaming_links = json_decode('{"" : ""}'); 
		$show->download_links = json_decode('{"":""}'); 
		$show->pubdate = date('Y-m-d');
		return $show;
	}
    
    public function get_with_references_details($id = NULL, $single = FALSE)
	{
        
        $this->db->select('shows.* , c.name as category_name, cou.name as country_name, l.name as language_name');
        
        $this->db->join('categories as c ' , 'shows.category_id = c.id' , 'left');
        $this->db->join('countries as cou ' , 'shows.country_id = cou.id' , 'left');
        $this->db->join('languages as l ' , 'shows.language_id = l.id' , 'left');
		//we added this to can avoid error of column-id-in-where-clause-is-ambiguous if we added $id as parameter for the function, so i defined the id for shows id.shows
		$this->_primary_key = $id == null ? $this->_primary_key : 'shows.'.$this->_primary_key;
        return parent::get($id,$single); 
    }
	
	
	public function get_shows_have_episodes($id)
	{
		return parent::get_by(array('has_episodes' => 1 , $this->_primary_key => $id));
	}
	
	
	
	public function change_to_new_category($old_category,$new_category)
	{
		$this->db->where('category_id', $old_category->id);
		
		if($this->db->set(array('category_id' => $new_category->id))->update($this->_table_name)){
			$this->session->set_flashdata('success', 'All shows that referenced to '. $old_category->name. ', now are referencing to '. $new_category->name. ' successfully');
		}
	}
	
	public function delete($id)
	{
		$id = validate_int($id);
		$show_episodes = $this->episode_m->get_by(array('show_id'=> $id));
		if($show_episodes) {
			$this->session->set_flashdata('error', 'This show has episodes, you have to delete all the episodes first');
		}else {
			parent::delete($id);
		}
	}
    
	
	//frontend functions
    
    
    public function get_shows_by_parent_category($parent_id, $limit = NULL, $offset = NULL)
    {
        $this->load->model('category_m');
		$this->db->select('id');
		$categories = $this->category_m->get_by(array('parent_id' => $parent_id ));
        
		$categories_array = array();
		foreach($categories as $category) {
            array_push($categories_array, $category->id);
        }
		if($limit || $offset) {
			$this->db->limit($limit , $offset);
		}
        
		$this->db->select('shows.* , c.name as category_name');
		$this->db->join('categories as c ' , 'shows.category_id = c.id' , 'left');
        $this->db->where_in('category_id' , $categories_array);
		
		return parent::get();	
    }
    
    
    public function shows_no_episodes()
    {
        $this->db->select('shows.* , c.name as category_name');
		$this->db->join('categories as c ' , 'shows.category_id = c.id' , 'left');
        return parent::get_by(array('has_episodes' => 0));
    }
    
    
   
    public function get_all_shows_and_episodes($limit = NULL, $offset = NULL)
    {
        $this->db->select('shows.* , c.name as category_name');
        $this->db->join('categories as c ' , 'shows.category_id = c.id' , 'left');
        $shows = parent::get_by(array('has_episodes' => 0));
       
        $episodes = $this->episode_m->get_episode_with_show();
        
        $all_array =  array_merge((array) $shows, (array) $episodes);
        //<=> returns 0 if both operands are equal, 1 if the left is greater, and -1 if the right is greater
        usort($all_array, function($item1,$item2){return strtotime($item2->pubdate) <=> strtotime($item1->pubdate);});
		
		if($limit || $offset) {
			$offset = $offset ? $offset : 0;
			$all_array = array_slice($all_array, $offset, $limit);
		}
		
        
        return (object) $all_array;
        
    }
	
	
	
	
	

	
	
	
}