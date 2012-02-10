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
		//$result->next_result();
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
		//$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getTodoBySubsystem($codename, $subsystemcode)
	{
		//$query = " CALL proc_todo_by_subsystem(?,?)";
		$query = "select idproject_todo,title,status,todo_type,outcome,username,onProgress from project_todo p inner join todo_type t on p.todotypecode = t.todotypecode where codename='".$codename."' and subsystemcode='".$subsystemcode."' and onProgress=0 order by status,todo_type, idproject_todo desc";
		$data = array($codename,$subsystemcode);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->result();
		//$result->next_result();
		$result->free_result();
		return $row_data;
	}
	
	function getProgressTodoByCodename($codename)
	{
		//$query = " CALL proc_todo_by_subsystem(?,?)";
		$query = "select idproject_todo,title,status,todo_type,outcome,username,onProgress from project_todo p inner join todo_type t on p.todotypecode = t.todotypecode where codename='".$codename."' and onProgress=1 order by status,todo_type, idproject_todo desc";
		$data = array($codename);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->result();
		//$result->next_result();
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
		//$result->next_result();
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
		$data = array('status'=>$nextStatus,'outcome'=>$outcome,'completedAt'=>date('Y-m-d H:i:s'),'onProgress'=>'0');
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


	function toggleProgress($idproject_todo,$onProgress)
	{
		$toggled=0;
		if($onProgress==0) $toggled=1; else $toggled=0;
		$data = array('onProgress'=>$toggled);
		$this->db->where('idproject_todo',$idproject_todo);
		$this->db->update('project_todo',$data);
	}
	
	function getRecentUpdates($codename)
	{
		$query = "select idproject_todo,title,status,todo_type,outcome,username,onProgress,completedAt from project_todo p inner join todo_type t on p.todotypecode = t.todotypecode where codename='".$codename."' and status='DONE' order by completedAt desc limit 0,5";
		$data = array($codename);
		$result = $this->db->query($query,$this->safe_escape($data));
		$row_data = $result->result();
		//$result->next_result();
		$result->free_result();
		return $row_data;
	}

	function saveProject($oldCodename,$codename,$title,$description)
	{
		if($oldCodename=='')
		{
			$data=array('codename'=>$codename,'title'=>$title,'description'=>$description,'completion'=>0);
			$this->db->insert('project',$data);
			
			$data2=array('username'=>$this->session->userdata('user_credential')->username,'codename'=>$codename,'rolecode'=>'PRG');
			$this->db->insert('project_contributor',$data2);
		}else
		{
		}
	}
	
	function saveSubsystem($codename, $oldSubsystemcode,$subsystemcode,$title,$description)
	{
		if($oldSubsystemcode=='')
		{
			$data=array('codename'=>$codename,'subsystemcode'=>$subsystemcode,'title'=>$title,'description'=>$description);
			$this->db->insert('project_subsystem',$data);
		}else
		{
		}
	}
}