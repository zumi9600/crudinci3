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
		$this->load->model('Sale_model');
		if ($this->ion_auth->logged_in()) {
			$user = $this->Ion_auth_model->user()->row();
			$sales_total = $this->Sale_model->saleSum();
			$sales_per_month = $this->Sale_model->getSalesPerMonth();
			$month_name = array();
			$sale_array = array();
			foreach ($sales_per_month as $sale) {
				$monthNum  = $sale['month'];
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				$monthName = $dateObj->format('F');
				array_push($month_name, $monthName);
				array_push($sale_array, $sale['num_of_sales']);
			}
			$data['user'] = $user;
			$data['title'] = 'AdminLTE 3 | Dashboard';
			$data['page_name'] = 'layout/content';
			$data['total_sales'] = $sales_total['total_sales'];
			$data['sales_per_month'] = $sale_array;
			$data['months_name'] = $month_name;
			$this->load->model('Ion_auth_model');
			$this->load->view('index', $data);
		} else {
			redirect('auth/login', 'refresh');
		}
	}
}
