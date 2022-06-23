<?php

class User extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
	}
	
	public function index()
	{
        $count = $this->db->count_all_results('users');
		
		$offset = $this->set_pagination($count);
		
		$this->db->limit(parent::PER_PAGE,$offset);
		$this->data['users'] = $this->user_m->get();
        
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	
	public function save($id = NULL)
	{
		$id = validate_int($id);
        
        if_extra_segment_redirect(5,'admin/user/save/'.$id);
		
		if($id == NULL){
			$this->data['user'] = $this->user_m->get_new();
		}else {
			$result = $this->user_m->get($id);
			$result || redirect('admin/user/save');
			$this->data['user'] = $result;
		}
		
		$rules = $this->user_m->save_user_rules;
		
		//if is new user so will set the rule to be required
		$id || $rules['password']['rules'] .= '|required';
		
		$unique_email = '|is_unique[users.email]';
		
		//if is edit and the user added the same email so will omit the unique rule, if diffrent add unique
		$id == NULL || $unique_email = ($this->input->post('email') == $this->data['user']->email) ? '' : '|is_unique[users.email]';
		
		$rules['email']['rules'] .= $unique_email;
		
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE) {
			
			$data = $this->user_m->array_from_post(array('first_name','last_name','email'));
			
			$password = $this->input->post('password');	
			
			if($password) {
				$data['password'] = $this->user_m->hash($password);
			}
			
			$this->user_m->save($data, $id);
			redirect('admin/user');
		}
		
		$this->data['subview'] = 'admin/user/save';
		$this->load->view('admin/_layout_main',$this->data);
		
	}
	
	public function delete($id)
	{
		$this->user_m->delete($id);
		redirect('admin/user');
	}
	
	
	public function login()
	{
		$this->user_m->is_logged_in() == FALSE || redirect('admin/dashboard');
		
		$this->form_validation->set_rules($this->user_m->login_rules);
		
		if($this->form_validation->run() == TRUE){

            $this->user_m->login() == FALSE || redirect('admin/dashboard');
			
			$this->session->set_flashdata('error','Email or password are not correct');
			redirect('admin/user/login', 'refresh');
			
		}
		
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/_layout_modal', $this->data);
	}
	
	
	public function logout()
	{
		$this->user_m->logout();
		redirect('admin/user/login');
	}
}