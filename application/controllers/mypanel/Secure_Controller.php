<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_Controller extends CI_Controller 
{
	/*
	* Controllers that are considered secure extend Secure_Controller, optionally a $module_id can
	* be set to also check if a user can access a particular module in the system.
	*/
	public function __construct($module_id = NULL, $submodule_id = NULL)
	{
		parent::__construct();
		$index_page='mypanel/';
		$this->load->model($index_page.'User');
		$this->lang->load('module',$this->Appconfig->get('language_code'));
		$this->lang->load('users',$this->Appconfig->get('language_code')); 
		$this->lang->load('customers',$this->Appconfig->get('language_code'));
		$this->lang->load('adverts',$this->Appconfig->get('language_code'));
		  
		$model = $this->User;
		$menu = $this->menu_lib;
		

		if(!$model->is_logged_in())
		{
			redirect($index_page.'login');
		}
		
		$this->has_module_grant($module_id,$submodule_id);
		$logged_in_user_info = $model->get_logged_in_user_info();
		
		/*Menu*/
		
		$segment_array=$this->uri->segment_array();
		$segments= array();
		$str='';
		foreach ($segment_array as $segment)
		{
			if ($segment !== reset($segment_array)) {
				
				$str.=$segment;
				if($segment=='profile'){
					if($model->has_module_grant('users', $logged_in_user_info->person_id)){
						$segments[0]='users';
					}
				}

				$segments[]=$str;
				$str.="_";
			}
		}
		
		$bread_crumb = array();
		$modules = array();
		$all_subpermissions=$this->Module->get_all_subpermissions()->result();
		foreach($this->Module->get_all_modules()->result() as $module)
		{
			if($this->User->has_grant($module->module_id,$logged_in_user_info->person_id)){
	            $module->href=base_url($index_page.$module->module_id);
	            $module->icon=$module->module_icon;
	            $module->text=$this->lang->line($module->name_lang_key);
				$module->module_parent=0;

				foreach($all_subpermissions as $permission)
				{
					if($this->User->has_grant($permission->permission_id,$logged_in_user_info->person_id)){
						$exploded_permission = explode('_', $permission->permission_id);
						if ($permission->module_id == $module->module_id)
						{
							$lang_key = $module->module_id.'_'.$exploded_permission[1];
							$lang_line = $this->lang->line($lang_key);
							$lang_line = ($this->lang->line_tbd($lang_key) == $lang_line) ? $exploded_permission[1] : $lang_line;
							if (empty($lang_line))
							{
								continue;
							}
							if($module->module_id===$exploded_permission[1]){
								$permission->href=base_url($index_page.$module->module_id);
							}else{
								$permission->href=base_url($index_page.$module->module_id.'/'.$exploded_permission[1]);
							} 
							
				            $permission->text=$lang_line;
							$permission->module_parent=$module->module_id;
							$permission->module_id=$permission->permission_id;
							$modules[] = $permission;
						}
					}
				}


				if($module->module_id=='profile'){
	            	if($model->has_module_grant('users', $logged_in_user_info->person_id)){
	            		$module->module_parent='users';
	            		$module->icon='';
	            	}
            	}

				$modules[] = $module;
			}
		}
		

		// llena el array bread_crumb

		foreach ($modules as $key => $value) {
			
			foreach($segments as $segment)
			{
				if($value->module_id==='home'){
					$bread_crumb[0]=$value;

				}elseif($value->module_id===$segment) {
					if(current($segments)===$segment){
						$str=$bread_crumb[0];
						array_shift($bread_crumb);
						array_unshift($bread_crumb, $str, $value);
					}else{
						$bread_crumb[]=$value;
					}
				}
			}
		}
			
		$li_header= array(
			'name_lang_key' =>'module_main',
			'module_id' =>'main',
			'module_parent' =>'0',
			'li_class'=>'header',
			'text'=> 'Navegación Principal'
			 );
		array_unshift($modules, (object) $li_header);
		
		$config['ul-root']=array('class'=>'list');
		$config['ul']=array('class'=>'ml-menu');
		$config['a-parent']=array('class'=>"menu-toggle");
					
		$menu->init($config);

		$menu->setResult($modules, 'module_id', 'module_parent');

		// bread_crumb
		foreach($bread_crumb as $segment)
		{
			$segment->icon=(isset($segment->icon))?$segment->icon:NULL;
			$segment->module_parent='0';
			$segment->badge=NULL;
			
		}

		if(empty($bread_crumb)){
			$bread_crumb[0]=(object) array(
				'name_lang_key' => 'module_home',
	            'desc_lang_key' => 'module_home_desc',
	            'sort' => '1',
	            'module_id' => 'home',
	            'module_icon' => 'home',
	            'status' => '0',
	            'href' => base_url(),
	            'icon' => 'home',
	            'text' => $this->lang->line('module_home'),
	            'module_parent' => '0',
	            'badge' => ''  
			);
		}

		
///////////////////////////////////////////////////////////////////////////////////
		$href = $this->uri->segment_array();
		$url=array();
		$str='';
		foreach ($href as $segment)
		{
			if ($segment === reset($href)) {
				$str.=$segment;
				if($segment.'/'==$index_page){
					$url[]=base_url($str.'/home');
				}else{
					$url[]=base_url($str);
				}
			}else{
				$str.=$segment;
				if($segment=='profile'){
					if($model->has_module_grant('users', $logged_in_user_info->person_id)){
						$url[]=base_url('users');
					}
				}

				if($index_page.'home'!=$str){
					$url[]=base_url($str);
				}
				
			}
			$str.="/";
		}

		if($this->uri->total_segments()==0){
			$url[]=base_url('home');
		}

		$menu->setActiveItem($url);
		// load up global data visible to all the loaded views
		$data['menu'] = $menu->html();
		//$data['contact_info']= $this->contact_lib->get_contact();
		
		/*MENUU*/
		
		
		
		//bread_crumb
		$config2['ul-root']=array('class'=>'breadcrumb');
		$config2['active_link']=FALSE;
		$menu->init($config2);
		$menu->setResult($bread_crumb, 'module_id', 'module_parent');
		$menu->setActiveItem(base_url($this->uri->uri_string()));
		$data['menu_bread'] = $menu->html();
		//end bread_crumb

		$data['user_info'] = $logged_in_user_info;
		$data['controller_name'] = $module_id;
		$data['submodule'] = $submodule_id;
		$this->load->vars($data);
	}

	public function has_module_grant($module_id = NULL, $submodule_id = NULL)
	{
		
		$model = $this->User;
		$logged_in_user_info = $model->get_logged_in_user_info();
		if(!$model->has_module_grant($module_id, $logged_in_user_info->person_id) || 
			(isset($submodule_id) && !$model->has_module_grant($submodule_id, $logged_in_user_info->person_id)))
		{
			if(empty($submodule_id)){
				redirect('no_access/' . $module_id);
			}else{
				redirect('no_access/' . $module_id . '/' . $submodule_id);
			}
			
		}
	}
	
	/*
	* Internal method to do XSS clean in the derived classes
	*/
	protected function xss_clean($str, $is_image = FALSE)
	{
		// This setting is configurable in application/config/config.php.
		// Users can disable the XSS clean for performance reasons
		// (cases like intranet installation with no Internet access)
		if($this->config->item('dgn_xss_clean') == FALSE)
		{
			return $str;
		}
		else
		{
			return $this->security->xss_clean($str, $is_image);
		}
	}

	public function numeric($str)
	{
		return parse_decimals($str);
	}

	public function check_numeric()
	{
		$result = TRUE;

		foreach($this->input->get() as $str)
		{
			$result = parse_decimals($str);
		}

		echo $result !== FALSE ? 'true' : 'false';
	}



}
?>