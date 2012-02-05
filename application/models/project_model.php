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
		//$query = " CALL proc_project_by_username(?)";
		$query = "select p.codename as id,concat(p.codename,' - ',p.title) as title from project_contributor pc inner join project p on pc.codename=p.codename where pc.username='".$username."'";
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
	
	function getSubsystemByCodename($codename)
	{
		//$query = " CALL prco_subsystem_by_codename(?)";
		$query = "select subsystemcode,title,description,ordering from project_subsystem  where codename='".$codename."' order by ordering";
		$data = array($codename);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data=$result->result();
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getTodoBySubsystem($codename, $subsystemcode)
	{
		//$query = " CALL proc_todo_by_subsystem(?,?)";
		$query = "select idproject_todo,title,status,todo_type,outcome,username from project_todo p inner join todo_type t on p.todotypecode = t.todotypecode where codename='".$codename."' and subsystemcode='".$subsystemcode."' order by status,todo_type, idproject_todo desc";
		$data = array($codename,$subsystemcode);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->result();
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getSubsystemByCode($subsystemcode)
	{
		//$query = " CALL proc_subsystem_by_code(?)";
		$query = "  select subsystemcode,title,description from project_subsystem where subsystemcode='".$subsystemcode."'";
		$data = array($subsystemcode);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->row();
		$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function saveCompletion($idproject_todo,$nextStatus,$outcome)
	{
		/*$query = " CALL proc_todo_completion(?,?,?)";
		$data = array($idproject_todo,$nextStatus,$outcome);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->row();
		$result->next_result();
		$result->free_result();
		return $row_data;*/
		$data = array('status'=>$nextStatus,'outcome'=>$outcome,'completedAt'=>date('Y-m-d'));
		$this->db->where('idproject_todo',$idproject_todo);
		$this->db->update('project_todo',$data);
	}
	
	function saveTodo($idproject_todo, $title,$status,$codename,$subsystemcode,$username,$todotypecode)
	{
		
		$data=array('title'=>$title,'status'=>$status,'codename'=>$codename,'subsystemcode'=>$subsystemcode,'username'=>$username,'todotypecode'=>$todotypecode);
		if($idproject_todo==-1)
			$this->db->insert('project_todo',$data);
		else
		{
			$this->db->where('idproject_todo',$idproject_todo);
			$this->db->update('project_todo',$data);
		}
	}
	
	function deleteTodo($idproject_todo)
	{
		$this->db->where('idproject_todo',$idproject_todo);
		$this->db->delete('project_todo');
	}
	
	
	function getTodoTitleById($idproject_todo)
	{
		$this->db->select('*');
		$this->db->where('idproject_todo',$idproject_todo);
		return $this->db->get('project_todo')->row();
	}
	
	function getTodoType()
	{
		$this->db->select('todotypecode as id, todo_type as title');
		$this->db->order_by('todotypecode');
		$result = $this->db->get('todo_type');
		
		$row_data=array();
	  	foreach($result->result_array() as $row)
		{
			  $row_data[$row['id']]=$row['id']." - ".$row['title'];
		}
		return $row_data;
	}
	
	function countProjectCompletion($codename)
	{
		$completion = 0;
		$result = $this->db->query("select status,count(*) as size from project_todo where codename='".$codename."' and todotypecode<>'ID' group by status");
		$row_data=$result->result();
		$waiting=0; 
		$done=0;
		$total=0;
	  	foreach($result->result_array() as $row)
		{
			
			if($row['status']=='Waiting') 
			{
				$waiting = $row['size'];
				$total+=$waiting;
			}
			elseif($row['status']=='DONE') 
			{
				$done=$row['size'];
				$total+=$done;
			}
		}
	
		if($total==0) return 0.00;
		return number_format($done/$total*100,2);// $done;
	}
	
	function countSubsystemCompletion($codename, $subsystemcode)
	{
		$completion = 0;
		$result = $this->db->query("select status,count(*) as size from project_todo where codename='".$codename."' and todotypecode<>'ID' and subsystemcode='".$subsystemcode."' group by status");
		$row_data=$result->result();
		$waiting=0; 
		$done=0;
		$total=0;
	  	foreach($result->result_array() as $row)
		{
			
			if($row['status']=='Waiting') 
			{
				$waiting = $row['size'];
				$total+=$waiting;
			}
			elseif($row['status']=='DONE') 
			{
				$done=$row['size'];
				$total+=$done;
			}
		}
	
		if($total==0) return 0.00;
		return number_format($done/$total*100,2);// $done;
	}

}