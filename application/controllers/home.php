<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Project_model');
    }
	public function index()
	{
		$user_credential=$this->session->userdata('user_credential');
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$data['todo']=array();
		$this->load->view('home',$data);
	}
	
	public function doOpenProject()
	{
		if($this->input->post("OpenProject"))
		{
			$codename = $this->input->post('cboProject');
			$this->session->set_userdata('openProject',$codename);
			$subsystem = $this->Project_model->getByCodename($codename);
			$data['subsystem']=$subsystem;
		}
		$user_credential=$this->session->userdata('user_credential');
		$data['todo']=array();
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$this->load->view('home',$data);
	}
	
	public function doOpenTodo($subsystemcode)
	{
		$user_credential=$this->session->userdata('user_credential');
		$codename = $this->session->userdata('openProject');
		$data['todo'] = $this->Project_model->getTodoBySubsystem($codename,$subsystemcode);
		$data['subsystem'] = $this->Project_model->getByCodename($codename);
		$data['project'] = $this->Project_model->getByUsername($user_credential->username);
		$this->load->view('home',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */