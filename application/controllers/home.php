<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		if($this->session->userdata('user_credential')==NULL) redirect('seriously');
	}
	
	public function defineVariables()
	{
		$data['project']=array();
		$data['todo']=array();
		$data['subsystem']=array();
		$data['projectCompletion']='';
		$data['subsystemCompletion']='';
		$data['progressTodo']=array();
		$data['recentUpdates']=array();
		return $data;
	}
	public function index()
	{
		$data=$this->defineVariables();
		$user_credential=$this->session->userdata('user_credential');
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$this->load->view('home',$data);
	}
	
	public function openTodoForm($idproject_todo)
	{
		$data['todoTypeList']=$this->Project_model->getTodoType();
		$codename=$this->session->userdata('openProject');
		$data['subsystemList']=$this->Project_model->getSubsystemList($codename);
		
	
		$data['idproject_todo']=$idproject_todo;
		if($idproject_todo==-1)
		{
			$data['title']='';
			$data['todoType']='';
			$data['subsystemcode']='';
		} else {
			$project_todo = $this->Project_model->getTodoTitleById($idproject_todo);
			$data['title']=$project_todo->title;
			$data['todoType']=$project_todo->todotypecode;
			$data['subsystemcode']=$project_todo->subsystemcode;
		}
		$this->load->view('todo_form',$data);
	}
	
	public function saveTodo()
	{
		$codename = $this->session->userdata('openProject');
		$username = $this->session->userdata('user_credential')->username;
		$idproject_todo=$this->input->post('idproject_todo');
		$todotypecode=$this->input->post('cboTodoType');
		$subsystemcode =$this->input->post('cboSubsystem');
		$this->Project_model->saveTodo($idproject_todo, $this->input->post('txtTitle'),'Waiting',$codename,$subsystemcode,$username,$todotypecode);
		redirect('home/doOpenSubsystem/'.$subsystemcode);
	}
	
	public function confirmTodoDelete($idproject_todo)
	{
		$data['idproject_todo']=$idproject_todo;
		$data['title']=$this->Project_model->getTodoTitleById($idproject_todo)->title;
		$this->load->view('delete_confirm_todo',$data);
	}
	
	public function deleteTodo($idproject_todo)
	{
		$this->Project_model->deleteTodo($idproject_todo);
		redirect('home/doOpenSubsystem/'.$this->session->userdata('openSubsystemCode'));
	}
	public function doOpenProject()
	{
		$data=$this->defineVariables();
		if($this->input->post("OpenProject"))
		{
			$codename = $this->input->post('cboProject');
			$this->session->set_userdata('openProject',$codename);
			$subsystem = $this->Project_model->getSubsystemByCodename($codename);
			$data['subsystem']=$subsystem;
			$this->session->unset_userdata('openSubsystem');
			$this->session->unset_userdata('openSubsystemCode');
			
		
		}
		$user_credential=$this->session->userdata('user_credential');
		$data['todo']=array();
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$data['projectCompletion']=$this->Project_model->countProjectCompletion($codename);
		$data['progressTodo']=$this->Project_model->getProgressTodoByCodename($codename);
		$data['recentUpdates']=$this->Project_model->getRecentUpdates($codename);
		$this->load->view('home',$data);
	}
	
	public function doOpenSubsystem($subsystemcode)
	{
		$data=$this->defineVariables();
		$user_credential=$this->session->userdata('user_credential');
		$codename = $this->session->userdata('openProject');
		$subsystem = $this->Project_model->getSubsystemByCode($codename, $subsystemcode);
		$this->session->set_userdata('openSubsystem',$subsystem);
		$this->session->set_userdata('openSubsystemCode',$subsystemcode);
		
		$data['todo'] = $this->Project_model->getTodoBySubsystem($codename,$subsystemcode);
		$data['subsystem'] = $this->Project_model->getSubsystemByCodename($codename);
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$data['projectCompletion']=$this->Project_model->countProjectCompletion($codename);
		$data['subsystemCompletion']=$this->Project_model->countSubsystemCompletion($codename, $subsystemcode);
		$data['progressTodo']=$this->Project_model->getProgressTodoByCodename($codename);
		$data['recentUpdates']=$this->Project_model->getRecentUpdates($codename);
		$this->load->view('home',$data);
	}
	
	public function openCompletionForm($idproject_todo,$status)
	{
	
		$data['idproject_todo']=$idproject_todo;
		$this->load->view('completion_form',$data);
	}
	
	public function saveCompletion($idproject_todo)
	{
		$data=$this->defineVariables();
		$nextStatus='DONE';//no, there is no turning back.. :)
		$outcome=$this->input->post('txtOutcome');
		$this->Project_model->saveCompletion($idproject_todo,$nextStatus,$outcome);
		
		$user_credential=$this->session->userdata('user_credential');
		$codename = $this->session->userdata('openProject');
		$subsystem=$this->session->userdata('openSubsystemCode');
		
		$data['todo'] = $this->Project_model->getTodoBySubsystem($codename,$subsystem);
		$data['subsystem'] = $this->Project_model->getSubsystemByCodename($codename);
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$data['projectCompletion']=$this->Project_model->countProjectCompletion($codename);
		$this->load->view('home',$data);
	}
	
	public function showOutcome($idproject_todo)
	{
		$todo = $this->Project_model->getTodoTitleById($idproject_todo);
		if($todo->outcome=='') echo 'Sorry, no outcome saved';
		else echo '<strong>' . $todo->outcome."</strong>";
	}
	
	public function toggleProgress($idproject_todo,$onProgress)
	{
		$this->Project_model->toggleProgress($idproject_todo,$onProgress);
		redirect('home/doOpenSubsystem/'.$this->session->userdata('openSubsystemCode'));
	}

	public function openProjectForm($codename)
	{
	    if($codename<>-1)
		{
		}
		$data['title']='';
		$data['description']='';
		$data['codename']='';
		$data['oldCodename']='';
		$this->load->view('project_form',$data);
	}
	
	public function saveProject()
	{
		$oldCodename=$this->input->post('oldCodename');
		$codename=$this->input->post('codename');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$this->Project_model->saveProject($oldCodename,$codename,$title,$description);
		$this->session->set_userdata('codename',$codename);
		redirect('home');
	}
	
	public function openSubsystemForm($subsystemcode)
	{
		$data['subsystemcode']='';
		$data['title']='';
		$data['description']='';
		if($subsystemcode<>-1)
		{
		
		}
		$this->load->view('form_subsystem',$data);
	}
	
	public function saveSubsystem()
	{
		$oldSubsystemcode=$this->input->post('oldSubsystemcode');
		$subsystemcode=$this->input->post('subsystemcode');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$codename = $this->session->userdata('openProject');
		$this->Project_model->saveSubsystem($codename, $oldSubsystemcode,$subsystemcode,$title,$description);
		if($subsystemcode!="") redirect('home/doOpenSubsystem/'.$subsystemcode);//better to open the newly added subsystem 
		redirect('home/doOpenProject');
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */