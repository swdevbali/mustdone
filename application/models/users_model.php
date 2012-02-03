<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function doLogin($username, $password)
	{
		$query = $this->db->get_where('users', array('username' => $username,'password'=>md5($password)));
		$row=$query->result();
		
		if(count($row)>0) return $row[0];
		return NULL;
	}
}