<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Users_model');
    }
	public function index()
	{
		$this->load->view('login');
	}
	
	public function doLogin()
	{
		if($this->input->post('Submit'))
		{
			$username = $this->input->post('txtUsername');
			$password = $this->input->post('txtPassword');
			$user = $this->Users_model->doLogin($username,$password);
			if($user!=NULL){
				$this->session->set_userdata('user_credential',$user);
				redirect('home');
			}else
			{
				$this->session->set_flashdata('message','Y U No Sign Up???');
				redirect('login');
			}
		}
	}
	
	public function confirmLogout()
	{
		
		$this->load->view('confirm_logout');
	}
	public function doLogout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */