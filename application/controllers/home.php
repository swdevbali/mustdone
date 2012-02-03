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
		
		$this->load->view('home',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */