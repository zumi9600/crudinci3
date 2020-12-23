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
        $this->load->model('Ion_auth_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $products = $this->Product_model->list();
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
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
            $data = array();
            // $dataInfo = array(); 
            // $photos = array(); 
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $brands = $this->Brand_model->list();
            $data['brands'] = $brands;
            $data['title'] = "Add a product";
            $data['page_name'] = 'addproduct/addproduct';
            //Validate records
            if ($this->input->post()) {
                $config = [
                    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/crudinci3/public/images/product/', 'allowed_types' => 'gif|jpg|png|jpeg',
                ];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->form_validation->set_rules('name', ' Name', 'required');
                $this->form_validation->set_rules('price', ' Price', 'required');
                $this->form_validation->set_rules('quantity', ' Quantity', 'required');
                $this->form_validation->set_rules('brand', ' Brand', 'required');
                $this->form_validation->set_rules('category', ' Category', 'required');
                $this->form_validation->set_rules('subcategory', ' Subcategory', 'required');
                if ($this->form_validation->run() === TRUE && $this->upload->do_upload('photo')) {
                    //Save records to DB
                    $formArray = array();
                    // Single file upload
                    $data = $this->upload->data();
                    $image_path = $data['raw_name'] . $data['file_ext'];
                    $formArray['photo'] = $image_path;
                    $formArray['name'] = $this->input->post('name');
                    $formArray['price'] = $this->input->post('price');
                    $formArray['quantity'] = $this->input->post('quantity');
                    $formArray['brand'] = $this->input->post('brand');
                    $formArray['category'] = $this->input->post('category');
                    $formArray['subcategory'] = $this->input->post('subcategory');
                    $formArray['created_at'] = date('Y-m-d');
                    // Getting id of last inserted product
                    $last_id = $this->Product_model->create($formArray); //call create function and passing data(array) in model

                    // Multiple file upload
                    // Count total files

                    // echo "<pre>";
                    // print_r($last_id);
                    // print_r($_FILES);
                    // // exit;
                    $countfiles = count($_FILES['files']['name']);
                    $image_name = array();

                    // Looping all files
                    for ($i = 0; $i < $countfiles; $i++) {
                        if (!empty($_FILES['files']['name'][$i])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                            // Set preference
                            $config['file_name'] = $_FILES['files']['name'][$i];

                            //Load upload library
                            $this->load->library('upload', $config);

                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $data = array('upload_data' => $this->upload->data());
                                $image_name[$i]['name'] = $data['upload_data']['file_name'];
                                $image_name[$i]['product'] = $last_id;
                            }
                        }
                    }
                    // echo '<pre>';
                    // print_r($image_name);
                    // exit;
                    if (!empty($image_name)) {
                        // Insert files data into the database
                        $this->Product_model->multipleImages($image_name);
                    }
                    $this->session->set_flashdata('success', 'Records added successfully!'); //Message will be shown once after record insertion
                    redirect('product', 'referesh');
                } else {
                    $upload_error = $this->upload->display_errors();
                    $data['upload_error'] = $upload_error;
                    $this->load->view('index', $data);
                }
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
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $product = $this->Product_model->getProduct($id);
            $brands = $this->Brand_model->list();
            $categories = $this->Category_model->getCategoryByBrandId($product['brand']);
            $subcategories = $this->Subcategory_model->getSubcategoryByCategoryId($product['category']);
            $photos = $this->Product_model->photoByProductId($id);
            // echo '<pre>';
            // print_r($product);
            // exit;
            $data['photos'] = $photos;
            $data['brands'] = $brands;
            $data['categories'] = $categories;
            $data['subcategories'] = $subcategories;
            $data['product'] = $product;
            $data['title'] = "Edit a product";
            $data['page_name'] = 'editproduct/editproduct';
            if ($this->input->post()) {
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('price', 'Price', 'required');
                $this->form_validation->set_rules('quantity', 'Quantity', 'required');
                $this->form_validation->set_rules('brand', ' Brand', 'required');
                $this->form_validation->set_rules('category', ' Category', 'required');
                $this->form_validation->set_rules('subcategory', ' Subcategory', 'required');
                if ($this->form_validation->run() === TRUE) {
                    $formArray = array();
                    // Update product
                    if (!empty($_FILES['photo']['size']) && $_FILES['photo']['name'] != $product['photo']) {
                        // echo '<pre>';
                        // print_r($_FILES);

                        $config = [
                            'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/crudinci3/public/images/product/',
                            'allowed_types' => 'gif|jpg|png|jpeg',
                        ];
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $this->upload->do_upload('photo');
                        $data = $this->upload->data();
                        $image_path = $data['raw_name'] . $data['file_ext'];
                        $file_name = $config['upload_path'] .  $product['photo'];
                        // print_r($file_name);
                        // exit;
                        if (file_exists($file_name)) {
                            unlink($file_name);
                        }
                        $formArray['photo'] = $image_path;
                    } else {
                        if (empty($product['photo'])) {
                            $formArray['photo'] = '';
                        }
                    }
                    $formArray['name'] = $this->input->post('name');
                    $formArray['price'] = $this->input->post('price');
                    $formArray['quantity'] = $this->input->post('quantity');
                    $formArray['brand'] = $this->input->post('brand');
                    $formArray['category'] = $this->input->post('category');
                    $formArray['subcategory'] = $this->input->post('subcategory');
                    $this->Product_model->updateProduct($formArray, $id);
                    // Multiple file upload
                    // Count total files
                    $countfiles = count($_FILES['files']['name']);
                    $image_name = array();
                    // echo '<pre>';
                    // print_r($countfiles);
                    // exit;
                    // Looping all files
                    for ($i = 0; $i < $countfiles; $i++) {
                        if (!empty($_FILES['files']['name'][$i])) {
                            $config = [
                                'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/crudinci3/public/images/product/',
                                'allowed_types' => 'gif|jpg|png|jpeg',
                            ];
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                            // Set preference
                            $config['file_name'] = $_FILES['files']['name'][$i];
                            //Load upload library

                            // File upload
                            if (!empty($_FILES['file']['size'] > 0)) {
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                $this->upload->do_upload('file');

                                // Get data about the file
                                $data = array('upload_data' => $this->upload->data());

                                $image_name[$i]['name'] = $data['upload_data']['file_name'];
                                $image_name[$i]['product'] = $id;
                                $file_name = $config['upload_path'] . $_FILES['files']['name'][$i];
                                // print_r($file_name);
                                // exit;
                                // if (file_exists($file_name)) {
                                //     unlink($file_name);
                                // }
                            }
                        }
                    }
                    if (!empty($image_name)) {
                        // Insert files data into the database
                        $this->Product_model->multipleImages($image_name);
                    }
                    $this->session->set_flashdata('success', 'Records updated successfully!');
                    redirect('product', 'referesh');
                } else {
                    $this->load->view('index', $data);
                }
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
            } else {
                $formArray = array();
                $photos = array();
                $photos = $this->Product_model->photoByProductId($id);
                foreach ($photos as $photo) {
                    $photo['is_deleted'] = 1;
                    $this->Product_model->updatePhotos($photo, $photo['id']);
                }
                $formArray['is_deleted'] = 1;
                $this->Product_model->updateProduct($formArray, $id);
                $this->session->set_flashdata('success', 'Records deleted successfully!');
                redirect('product', 'referesh');
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function deleteImage()
    {
        if ($this->ion_auth->logged_in()) {
            // If post request is submitted via ajax 
            if ($this->input->post('id')) {
                $id = $this->input->post('id');
                $photo = $this->Product_model->getPhotoById($id);
                // Delete image from folder and then from db
                if ($photo) {
                    // Remove files from the server  
                    $photo['is_deleted'] = 1;
                    $this->Product_model->updatePhotos($photo, $photo['id']);
                    echo 1;
                }
            }
        }
    }
}
