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
		$result = $this->db->query($query,$this->safe_escape($data));//array('username'=>$username)//,array('username' => $username)
 	  	//var_dump($result->result());
	  	foreach($result->result_array() as $row)
		{
			  $row_data[$row['id']]=$row['title'];
		}
		return $row_data;
	}
}