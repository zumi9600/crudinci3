<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
        $this->load->model('Product_model');
        $this->load->model('Subcategory_model');
        $this->load->model('Brand_model');
        $this->load->model('Category_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $products = $this->Product_model->list();
            // echo '<pre>';
            // print_r($products);
            // exit;
            $data = array();
            $data['products'] = $products;
            $data['title'] = "Products";
            $data['page_name'] = 'products/products';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function create()
    {

        if ($this->ion_auth->logged_in()) {
            $brands = $this->Brand_model->list();
            $data = array();
            $data['brands'] = $brands;
            $data['title'] = "Add a product";
            $data['page_name'] = 'addproduct/addproduct';
            //Validate records
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('price', ' Price', 'required');
            $this->form_validation->set_rules('quantity', ' Quantity', 'required');
            $this->form_validation->set_rules('brand', ' Brand', 'required');
            $this->form_validation->set_rules('category', ' Category', 'required');
            $this->form_validation->set_rules('subcategory', ' Subcategory', 'required');
            if ($this->form_validation->run() === TRUE) {
                //Save records to DB
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['price'] = $this->input->post('price');
                $formArray['quantity'] = $this->input->post('quantity');
                $formArray['brand'] = $this->input->post('brand');
                $formArray['category'] = $this->input->post('category');
                $formArray['subcategory'] = $this->input->post('subcategory');
                $formArray['created_at'] = date('Y-m-d');
                $this->Product_model->create($formArray); //call create function and passing data(array) in model
                $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion
                redirect('product', 'referesh');
            } else {
                $this->load->view('index', $data);
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function edit($id)
    {

        if ($this->ion_auth->logged_in()) {
            $product = $this->Product_model->getProduct($id);
            $subcategories = $this->Subcategory_model->list();
            $categories = $this->Category_model->list();
            $brands = $this->Brand_model->list();
            $data = array();
            $data['product'] = $product;
            $data['subcategories'] = $subcategories;
            $data['brands'] = $brands;
            $data['categories'] = $categories;
            $data['title'] = "Edit a product";
            $data['page_name'] = 'editproduct/editproduct';
            //Validate records
            $this->form_validation->set_rules('name', ' Name', 'required');
            $this->form_validation->set_rules('price', ' Price', 'required');
            $this->form_validation->set_rules('quantity', ' Quantity', 'required');
            $this->form_validation->set_rules('brand', ' Brand', 'required');
            $this->form_validation->set_rules('category', ' Category', 'required');
            $this->form_validation->set_rules('subcategory', ' Subcategory', 'required');
            if ($this->form_validation->run() === TRUE) {
                // Update product
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['price'] = $this->input->post('price');
                $formArray['quantity'] = $this->input->post('quantity');
                $formArray['brand'] = $this->input->post('brand');
                $formArray['category'] = $this->input->post('category');
                $formArray['subcategory'] = $this->input->post('subcategory');
                $this->Product_model->updateProduct($formArray, $id);
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect('product', 'referesh');
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
            $product = $this->Product_model->getProduct($id);
            if (empty($product)) {
                $this->session->set_flashdata('failure', 'Record not found.');
                redirect('product', 'referesh');
            }
            $this->Product_model->deleteProduct($id);
            $this->session->set_flashdata('success', 'Record deleted successfully!');
            redirect('product', 'referesh');
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
