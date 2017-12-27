<?php
class Module extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
	
	function get_module_name($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);
		
		if ($query->num_rows() ==1)
		{
			$row = $query->row();
			return $this->lang->line($row->name_lang_key);
		}
		
		return $this->lang->line('error_unknown');
	}
	
	function get_module_desc($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);
		if ($query->num_rows() ==1)
		{
			$row = $query->row();
			return $this->lang->line($row->desc_lang_key);
		}
	
		return $this->lang->line('error_unknown');	
	}
	
	function get_all_permissions()
	{
		$this->db->from('permissions');

		return $this->db->get();
	}
	
	function get_all_subpermissions()
	{
		$this->db->from('permissions');
		$this->db->join('modules', 'modules.module_id=permissions.module_id');
		// can't quote the parameters correctly when using different operators..
		$this->db->where($this->db->dbprefix('modules').'.module_id!=', 'permission_id', FALSE);
		$this->db->order_by("item_sort", "asc");
		$this->db->where('show_menu', 1);
		return $this->db->get();
	}
	
	function get_all_modules()
	{
		$this->db->from('modules');
		$this->db->where('status', 0);
		$this->db->order_by("sort", "asc");
		return $this->db->get();		
	}
	
	function get_allowed_modules($person_id)
	{
		$this->db->from('modules');
		$this->db->join('permissions','permissions.permission_id=modules.module_id');
		$this->db->join('grants','permissions.permission_id=grants.permission_id');
		$this->db->where("person_id",$person_id);
		$this->db->order_by("modules.sort", "asc");
		return $this->db->get();		
	}
	
}
?>
