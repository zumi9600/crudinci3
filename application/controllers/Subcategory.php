<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory extends CI_Controller
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
        $this->load->model('Subcategory_model');
        $this->load->model('Brand_model');
        $this->load->model('Category_model');
        $this->load->model('Ion_auth_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $subcategories = $this->Subcategory_model->list();
            // echo '<pre>';
            // print_r($subcategories);
            // exit;
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['subcategories'] = $subcategories;
            $data['title'] = "View Subcategories";
            $data['page_name'] = 'subcategories/subcategories';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    function getCategory()
    {
        $brand_id = $this->input->post('id', TRUE);
        $data = $this->Subcategory_model->getCategoryByBrand($brand_id);
        echo json_encode($data);
    }
    function getSubcategory()
    {
        $category_id = $this->input->post('id', TRUE);
        $data = $this->Subcategory_model->getSubcategoryByCategory($category_id);
        echo json_encode($data);
    }
    public function create()
    {
        if ($this->ion_auth->logged_in()) {
            $brands = $this->Brand_model->list();
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['brands'] = $brands;
            $data['title'] = "Add a subcategory";
            $data['page_name'] = 'addsubcategory/addsubcategory';
            // Validate Records
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            if ($this->form_validation->run() === TRUE) {
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['brand'] = $this->input->post('brand');
                $formArray['category'] = $this->input->post('category');
                $formArray['created_at'] = date('Y-m-d');
                $this->Subcategory_model->create($formArray); //call create function and passing data(array) in model
                $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion
                redirect('subcategory', 'referesh');
            }
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function edit($id)
    {
        if ($this->ion_auth->logged_in()) {
            //Getting data from models and storing it in $data
            $subcategory = $this->Subcategory_model->getSubcategory($id);
            $categories = $this->Category_model->list();
            $brands = $this->Brand_model->list();
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['subcategory'] = $subcategory;
            $data['brands'] = $brands;
            $data['categories'] = $categories;
            $data['title'] = "Edit a subcategory";
            $data['page_name'] = 'editsubcategory/editsubcategory';
            //Validate records
            $this->form_validation->set_rules('name', ' Name', 'required');
            $this->form_validation->set_rules('brand', 'Brand', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            if ($this->form_validation->run() === TRUE) {
                // Update category
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['brand'] = $this->input->post('brand');
                $formArray['category'] = $this->input->post('category');
                $this->Subcategory_model->updateSubcategory($formArray, $id);
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect('subcategory', 'referesh');
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
            $subcategory = $this->Subcategory_model->getSubcategory($id);
            if (empty($subcategory)) {
                $this->session->set_flashdata('failure', 'Record not found.');
                redirect('subcategory', 'referesh');
            } else {
                $formArray = array();
                $formArray['is_deleted'] = 1;
                $this->Subcategory_model->updateSubcategory($formArray, $id);
                $this->session->set_flashdata('success', 'Record deleted successfully!');
                redirect('subcategory', 'referesh');
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
