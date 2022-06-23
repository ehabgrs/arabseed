<?php

class Episode_m extends MY_model
{
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
	protected $_table_name = 'episodes';
	protected $_order_by = 'id desc'; 
	protected $_timestamps = TRUE;
	public    $rules =  array(
	
	    'show_id' => array(
             'field' => 'show_id',
             'label' => 'Show ID',
             'rules' => 'trim|required|intval' 
         ),
		 'episode_number' => array(
             'field' => 'episode_number',
             'label' => 'Episode number',
             'rules' => 'trim|required|intval' 
         ),
		 'episode_number_literally' => array(
             'field' => 'episode_number_literally',
             'label' => 'Episode number literally',
             'rules' => 'trim|required|max_length[100]'
         ),
		 'label' => array(
             'field' => 'label',
             'label' => 'Label',
             'rules' => 'trim|max_length[100]'
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
		$episode = new stdClass();
		$episode->episode_number ='';
		$episode->episode_number_literally ='';
		$episode->label ='';
		$episode->streaming_links = json_decode('{"" : ""}'); 
		$episode->download_links = json_decode('{"":""}'); 
		$episode->pubdate = date('Y-m-d');
		return $episode;
	}
    
	
	 public function get_episode_with_show($id = NULL, $single = FALSE)
	{
        
        $this->db->select('episodes.* , s.name as show_name , s.image as show_image');
        
        $this->db->join('shows as s ' , 'episodes.show_id = s.id' , 'left');

		//we added this to can avoid error of column-id-in-where-clause-is-ambiguous if we added $id as parameter for the function, so i defined the id for episodes id.episodes
		$this->_primary_key = $id == null ? $this->_primary_key : 'episodes.'.$this->_primary_key;
        return parent::get($id,$single); 
    }
	
    
	//frontend functions
	public function get_episodes_for_category($category_id, $limit = NULL, $offset = NULL)
	{
		$this->load->model('show_m');
		$this->db->select('id');
		$shows = $this->show_m->get_by(array('category_id' => $category_id ));
        
        $shows_array = array();
		foreach($shows as $show) {
            array_push($shows_array, $show->id);
        }
		
        if($limit || $offset) {
			$this->db->limit($limit , $offset);
		}
		
		$this->db->select('episodes.* , s.name as show_name , s.image as show_image');
		$this->db->join('shows as s ' , 'episodes.show_id = s.id' , 'left');
        $this->db->where_in('show_id',$shows_array);
        $this->_order_by = 'pubdate desc, id desc';
		
		return parent::get();	
	}
    
    
    public function get_all_episodes()
	{
		
		$this->db->select('episodes.* , s.name as show_name , s.image as show_image');
		$this->db->join('shows as s ' , 'episodes.show_id = s.id' , 'left');
        $this->_order_by = 'pubdate desc, id desc';
		
		return parent::get();	
	}
	
	
	public function get_episodes_for_show($show_id)
	{
		$this->db->select('episodes.* , s.name as show_name , s.image as show_image');
        $this->db->join('shows as s ' , 'episodes.show_id = s.id' , 'left');
		return parent::get_by(array('show_id' => $show_id));
	}
	
	
 
 
	
}