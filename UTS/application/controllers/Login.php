<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('login_model');

	}

	public function index()
	{
		$data['title']='Login';		
		$this->load->view('login/index',$data);
	}

	public function proses_login()
	{
		$username=$this->input->post('uname1');
		$password=$this->input->post('pwd1');

		$ceklogin=$this->login_model->login($username,$password);

		if ($ceklogin) {
			foreach ($ceklogin as $row);
				$this->session->set_userdata('user',$row->username);
				$this->session->set_userdata('level',$row->level);
			
			if ($this->session->userdata('level')=="admin") 
			{
				redirect('Home');
			}
			elseif ($this->session->userdata('level')=="user")
			{
				redirect('Home');
			}

		} else {
			$data['pesan']="Masukkan username dan password anda";
			$data['title']='Login';
			$this->load->view('template/header_login',$data);
			$this->load->view('login/index');
			$this->load->view('template/footer');
			//redirect('login/index','refresh');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */ ?>