<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function safe_escape(&$data)
    {
        if(count($data) <= 0)
        {
            return $data;
        }
        
        foreach($data as $node)
        {
            $node = $this->db->escape($node);
        }
        
        return $data;
    }
	
	function getByUsername($username)
	{
		$query = " CALL proc_project_by_username(?)";
		$data = array($username);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data=array();
	  	foreach($result->result_array() as $row)
		{
			  $row_data[$row['id']]=$row['title'];
		}
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getByCodename($codename)
	{
		$query = " CALL prco_subsystem_by_codename(?)";
		$data = array($codename);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data=array();
	  	foreach($result->result_array() as $row)
		{
			  $row_data[$row['id']]=$row['title'];
		}
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getTodoBySubsystem($codename, $subsystemcode)
	{
		$query = " CALL proc_todo_by_subsystem(?,?)";
		$data = array($codename,$subsystemcode);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data=array();
	  	foreach($result->result_array() as $row)
		{
			  $row_data[$row['id']]=$row['title'];
		}
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
}