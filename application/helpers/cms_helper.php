<?php
 
function btn_edit($url)
{
    return anchor($url , 'Edit <i class="bi bi-pencil-square"></i>');
}

function btn_delete($url)
{
    return anchor($url , 'Delete <i class="bi bi-trash"></i>', array('onclick' => "return confirm('Are you sure you wanna delete this item')"));
}


//function to set the config for file upload
function image_common_config()
{
	$config['upload_path'] = './front/images/';
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']     = '2000';
	$config['max_width'] = '1024';
	$config['max_height'] = '768';
	return $config;
}


function pagination_links_config()
{
	$config['full_tag_open'] = '<nav aria-label="Page navigation example"> <ul class="pagination">';
	$config['full_tag_close'] = '</nav> </ul>';
	$config['num_tag_open'] = '<li class="page-item">'; 
	$config['num_tag_close'] = '</li>'; 
	$config['cur_tag_open'] = '<li class="page-item active"> <span class="page-link">'; 
	$config['cur_tag_close'] = '<span class="sr-only"></span></span></li>'; 
	$config['next_link'] = 'Next'; 
	$config['prev_link'] = 'Prev'; 
	$config['next_tag_open'] = '<li class="page-item">'; 
	$config['next_tag_close'] = '</li>'; 
	$config['prev_tag_open'] = '<li class="page-item">'; 
	$config['prev_tag_close'] = '</li>'; 
	$config['first_tag_open'] = '<li class="page-item">'; 
	$config['first_tag_close'] = '</li>'; 
	$config['last_tag_open'] = '<li class="page-item">'; 
	$config['last_tag_close'] = '</li>';
	$config['attributes'] = array('class' => 'page-link');

	return $config;
}



//function to remove the end of the link name, that i added to prevent same key values
function remove_link_name_suffix($name)
{
	return preg_replace('/(__\d{1,2}$)/', '', $name);
}

//to set the file upload name
function crypt_file_name($name)
{
	if($name !== '') {
		$app_salt = '$2a$07$yeNCSNwRpYopOhv0TrrReP$';
		preg_match_all('/([a-z]{1,4})$/i', $name, $m);
		$fileExtension = $m[0][0];
		$name = substr(strtolower(base64_encode($name . $app_salt)), 0, 30);
		$name = preg_replace('/(\w{6})/i', '$1_', $name);
		$name = rtrim($name, '_');
		return $name.'.'.$fileExtension ;
	}
	
}


function unlink_file($name)
{
	if($name !== '' && file_exists('./front/images/'.$name) && is_writable('./front/images/')) {
		unlink('./front/images/'.$name);
	}
}


//create the menu for the navbar for the frontend
function get_menu ($array, $child = FALSE)
{
	//if we used $this->uri->segment() will give us an error 'Using $this when not in object context'
	//so we make a new instance 
	$CI = & get_instance();
    $str ='';
    
    if($array) {
        
        foreach($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['slug'] ? 'active' : '';
			//echo '<script> alert( " ' . $item['title']. ' ' .$item['slug']. ' ' . $active . ' " )</script> ';
            if($child == FALSE) {
				
				if(isset($item['children']) && count($item['children'])) {
				
				$str .= '<li class="nav-item dropdown" '. $active . '> <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="' .site_url($item['slug']). '" role="button" aria-expanded="false">'.$item['name'].'</a> <ul class="dropdown-menu"> '. PHP_EOL;
				
                $str .=  get_menu($item['children'] , TRUE);
				
				$str .= '</ul></li>' . PHP_EOL;
				
				} else {
					
					$str .= '<li class="nav-item"> <a class="nav-link" ' .$active. ' aria-current="page" href="' .site_url($item['slug']). '" > ' . $item['name'] . '</a> </li> '. PHP_EOL;
					
				}
				
			} else {
				
				$str .= '<li> <a class="dropdown-item" href="'.site_url($item['slug']).'" ' .$active. '> '. $item['name']. '</a></li>'.PHP_EOL;
				
			}
        }
      
    }
    return $str;
}


function handle_json($json)
{
	return json_decode($json);
}


function image_link($name)
{
	return site_url('front/images/'.$name);
}

function episode_link($episode_array)
{
	$slug = url_title($episode_array->show_name.'-'.$episode_array->episode_number_literally);
	return site_url('episode/'.$episode_array->id.'/'.$slug);
}

function show_link($show)
{
	return site_url('show/'.$show->id.'/'.url_title($show->name));
}

function validate_int($int)
{
    return $int = filter_var($int, FILTER_VALIDATE_INT);
}

function validate_url_name($string)
{
    return $string = filter_var($string, FILTER_SANITIZE_URL);
}

function if_extra_segment_redirect($extra_segment,$redirect)
{
    $CI = & get_instance();
    
    if($CI->uri->segment($extra_segment)){
        redirect($redirect);
    }
}

function success_message($message)
{
	if($message){
		echo '<div class="alert alert-primary" role="alert">'.$message.'</div>';
	}
}

function alert_message($message)
{
	if($message){
		echo '<div class="alert alert-warning" role="alert">'.$message.'</div>';
	}
}

function set_meta_title($string)
{
	$CI = get_instance();
	$CI->data['meta_title'] = $CI->data['meta_title'] . '_' .$string;
}


?>