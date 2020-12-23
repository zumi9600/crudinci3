<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
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
        $this->load->model('Brand_model');
        $this->load->model('Ion_auth_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $brands = $this->Brand_model->list();
            $user = $this->Ion_auth_model->user()->row();
            $data = array();
            $data['user'] = $user;
            $data['brands'] = $brands;
            $data['title'] = "View Brands";
            $data['page_name'] = 'brands/brands';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function create()
    {
        if ($this->ion_auth->logged_in()) {
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['title'] = "Add a brand";
            $data['page_name'] = 'addbrand/addbrand';
            // Validate Records
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() === TRUE) {
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['created_at'] = date('Y-m-d');
                $this->Brand_model->create($formArray); //call create function and passing data(array) in model
                $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion
                redirect('brand', 'referesh');
            }
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function edit($id)
    {
        if ($this->ion_auth->logged_in()) {
            $brand = $this->Brand_model->getBrand($id);
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['brand'] = $brand;
            $data['title'] = "Edit a brand";
            $data['page_name'] = 'editbrand/editbrand';
            //Validate records
            $this->form_validation->set_rules('name', ' Name', 'required');
            if ($this->form_validation->run() === TRUE) {
                // Update product
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $this->Brand_model->updateBrand($formArray, $id);
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect('brand', 'referesh');
            } else {
                $this->load->view('index', $data);
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function delete($id)
    {
        if ($this->ion_auth->logged_in()) {
            $brand = $this->Brand_model->getBrand($id);
            if (empty($brand)) {
                $this->session->set_flashdata('failure', 'Record not found.');
                redirect('brand', 'referesh');
            } else {
                $formArray = array();
                $formArray['is_deleted'] = 1;
                $this->Brand_model->updateBrand($formArray, $id);
                $this->session->set_flashdata('success', 'Record deleted successfully!');
                redirect('brand', 'referesh');
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
