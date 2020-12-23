<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('ion_auth');
		$this->load->model('Ion_auth_model');
		if ($this->ion_auth->logged_in()) {
			$user = $this->Ion_auth_model->user()->row();
			$data['user'] = $user;
			$data['title'] = 'AdminLTE 3 | Dashboard';
			$data['page_name'] = 'layout/content';
			$this->load->model('Ion_auth_model');
			$this->load->view('index', $data);
		} else {
			redirect('auth/login', 'refresh');
		}
	}
}
