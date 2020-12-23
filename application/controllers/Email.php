<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
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
    public function __construct()
    {
        //load model
        parent::__construct();
        // $this->load->model('Subcategory_model');
        // $this->load->model('Brand_model');
        // $this->load->model('Category_model');
        $this->load->model('Ion_auth_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            // $data['subcategories'] = $subcategories;
            $data['title'] = "View Subcategories";
            $data['page_name'] = 'email/email';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function send()
    {
        // $from = $this->input->post('user_email');F
        
        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '60';
        // $config['smtp_user']    = $from;
        // $config['smtp_pass']    = '*******';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'text'; // or html
        // $config['validation'] = TRUE;

        
    }
}
