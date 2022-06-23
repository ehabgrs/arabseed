<?php

class Category extends Admin_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_m');
	}
	
	public function index()
	{   
	    set_meta_title('Categories');
		$count = $this->db->count_all_results('categories');
		
        $offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
		$this->data['categories'] = $this->category_m->get_with_parent_details();
		
        $this->data['subview'] = 'admin/category/index';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    public function save($id = NULL)
    {	
		$id = validate_int($id);
        
        if_extra_segment_redirect(5,'admin/language/save/'.$id);
        
        //set the values for the form
        if($id == NULL) {
			set_meta_title('Add a new category');
           $this->data['category'] = $this->category_m->get_new();
        }else {
		   set_meta_title('Update a category');
           $result = $this->category_m->get($id);
           $result || redirect('admin/category/save');
           $this->data['category'] = $result;
        }
		
        $this->data['parents'] = $this->category_m->get_categories_with_no_parents();
		
		$this->data['template_array'] = $this->category_m->template_array;
        
		//rules and save
        $rules = $this->category_m->rules;
        
        $unique_slug = '|is_unique[categories.slug]';
        
        $id == NULL || $unique_slug = ( $this->data['category']->slug == $this->input->post('slug') ) ? '' : '|is_unique[categories.slug]';
        $rules['slug']['rules'] .= $unique_slug;
        
        $this->form_validation->set_rules($rules);
        
        if($this->form_validation->run() == TRUE) {
            
            $data = $this->category_m->array_from_post(array(
                'name',
                'slug',
                'parent_id',
				'template'
            ));
            
            $this->category_m->save($data,$id);

            redirect('admin/category');
        }
        
        $this->data['subview'] = 'admin/category/save_category';
        $this->load->view('admin/_layout_main',$this->data);
    
    }
    
    
    public function delete($id = NULL)
    {
		$id = validate_int($id);
		$category = $this->category_m->get($id);
		
		($id && $category) || redirect('admin/category');
		
		if($this->category_m->delete($id) === 'shows') {
			redirect('admin/category/change_category/'.$id);
		}
		
	    redirect('admin/category'); 
    }
	
	
	public function change_category($id = NULL) {
		
		$id = validate_int($id);
		
		if_extra_segment_redirect(5,'admin/category/change_category/'.$id);
		
		$shows_for_category = $this->show_m->get_by(array('category_id'=> $id));
		if(!$shows_for_category ) {
			$this->session->set_flashdata('error', 'Sorry this category doesn\'t have shows reference for it');
			redirect('admin/category');
		}
		
		$category = $this->data['category'] = $this->category_m->get($id);
		$this->data['categories'] = $this->category_m->get_for_dropdown();
		
		$this->form_validation->set_rules('category', 'The new category' , 'trim|intval');
		
		if($this->form_validation->run() == TRUE) {
			
			$new_category_id = $this->input->post('new_category_id');
			$new_category = $this->category_m->get($new_category_id);
			
			$this->show_m->change_to_new_category($category,$new_category);
			
			redirect('admin/category/');
		}
		
		
		
		$this->data['subview'] = 'admin/category/change_category';
        $this->load->view('admin/_layout_main',$this->data);
	}
    
    
    public function order()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview']  = 'admin/category/order';
        $this->load->view('admin/_layout_main',$this->data);
    }
    
    public function order_ajax()
    {
        
        if(isset($_POST['sorted_data'])){
           
            $this->category_m->save_ordered_data($_POST['sorted_data']);
        }
        
        $this->data['nested_data'] = $this->category_m->get_nested();
        
        $this->load->view('admin/category/order_ajax', $this->data); 
    }
	
	
	public function test()
	{
		$int = '0';
        $int = filter_var($int, FILTER_VALIDATE_INT);
        echo $int;
       
	}
	

    
    
}