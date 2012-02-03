<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
	
	public function doLogout()
	{
		$this->session->unset_userdata('user_credential');
		redirect('/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */