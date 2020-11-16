<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
        $this->load->model('Category_model');
        $this->load->model('Brand_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $categories = $this->Category_model->list();
            // echo '<pre>';
            // print_r($categories);
            // exit;
            $data = array();
            $data['categories'] = $categories;
            $data['title'] = "View Categories";
            $data['page_name'] = 'categories/categories';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function create()
    {
        if ($this->ion_auth->logged_in()) {
            $brands = $this->Brand_model->list();
            $data['brands'] = $brands;
            $data['title'] = "Add a category";
            $data['page_name'] = 'addcategory/addcategory';
            // Validate Records
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            if ($this->form_validation->run() === TRUE) {
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['brand'] = $this->input->post('brand');
                $formArray['created_at'] = date('Y-m-d');
                $this->Category_model->create($formArray); //call create function and passing data(array) in model
                $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion
                redirect('category', 'referesh');
            }
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function edit($id)
    {
        if ($this->ion_auth->logged_in()) {
            $category = $this->Category_model->getCategory($id);
            $brands = $this->Brand_model->list();
            $data = array();
            $data['brands'] = $brands;
            $data['category'] = $category;
            $data['title'] = "Edit a category";
            $data['page_name'] = 'editcategory/editcategory';
            //Validate records
            $this->form_validation->set_rules('name', ' Name', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            if ($this->form_validation->run() === TRUE) {
                // Update category
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['brand'] = $this->input->post('brand');
                $this->Category_model->updateCategory($formArray, $id);
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect('category', 'referesh');
            } else {
                $this->load->view('index', $data);
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function delete($id)
    {
        $category = $this->Category_model->getCategory($id);
        if (empty($category)) {
            $this->session->set_flashdata('failure', 'Record not found.');
            redirect('category', 'referesh');
        }
        $this->Category_model->deleteCategory($id);
        $this->session->set_flashdata('success', 'Record deleted successfully!');
        redirect('category', 'referesh');
    }
}
