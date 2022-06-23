<?php

class User_m extends MY_Model
{
	//we will set just the things are not default
    protected $_table_name = 'users';
	protected $_order_by = 'last_name';
	
	public $save_user_rules = array(
	
	        'first_name'  => array(
			        'field' => 'first_name',
					'Label' => 'First name',
					'rules' => 'trim|required'
			),
			'last_name'  => array(
			        'field' => 'last_name',
					'Label' => 'First name',
					'rules' => 'trim|required'
			),
			'email'  => array(
			        'field' => 'email',
					'Label' => 'Email',
					'rules' => 'trim|required|valid_email'
			),
			'password'  => array(
			        'field' => 'password',
					'Label' => 'Password',
					'rules' => 'trim|matches[password_confirm]'
			),
			'password_confirm'  => array(
			        'field' => 'password_confirm',
					'Label' => 'Password confirm',
					'rules' => 'trim|matches[password]'
			),
			
	);
	
	public    $login_rules = array(
	
        'email' => array(
             'field' => 'email',
             'label' => 'Email',
             'rules' => 'trim|required|valid_email'
         ),
        'password' => array(
             'field' => 'password',
             'label' => 'Password',
             'rules' => 'trim|required'
         ),
    );
	
	
	public function get_new()
	{
		$user =  new stdClass();
		$user->first_name = '';
		$user->last_name = '';
		$user->password = '';
		$user->email = '';
		return $user;
	}
	
	
	public function hash($string)
	{
		return hash('sha512' , $string . config_item('encryption_key'));
	}
	
	public function login()
	{
		$user = $this->get_by( array('email' => $this->input->post('email'), 'password' => $this->hash($this->input->post('password'))), TRUE );
		
		if($user) {
			
			$data = array(
			    'first_name'  => $user->first_name,
				'last_name'   => $user->last_name,
				'email'       => $user->email,
				'id'          => $user->id,
				'loggedin'    => TRUE
			);
			
			$this->session->set_userdata($data);
			return true;
		} else {
			return false;
		}
	}
	
	public function is_logged_in()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
	}

}