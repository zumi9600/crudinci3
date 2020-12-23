<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
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
        $this->load->model('Customer_model');
        $this->load->model('Ion_auth_model');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            $customers = $this->Customer_model->list();
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['customers'] = $customers;
            $data['title'] = "Customers";
            $data['page_name'] = 'customers/customers';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function create()
    {
        if ($this->ion_auth->logged_in()) {
            $data = array();
            $user = $this->Ion_auth_model->user()->row();
            $data['user'] = $user;
            $data['title'] = "Add a customer";
            $data['page_name'] = 'addcustomer/addcustomer';
            //Validate records
            if ($this->input->post()) {
                $config = [
                    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/crudinci3/public/images/customer/', 'allowed_types' => 'gif|jpg|png|jpeg',
                ];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->form_validation->set_rules('firstname', 'First Name', 'required');
                $this->form_validation->set_rules('lastname', 'Last Name', 'required');
                $this->form_validation->set_rules('gender', ' Gender', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('birthdate', ' Date of Birth', 'required');
                $this->form_validation->set_rules('country', 'Country', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                if ($this->form_validation->run() === TRUE) {
                    //Save records to DB
                    // print_r("validate");
                    // exit;
                    $formArray = array();
                    // Single file upload
                    if ($this->upload->do_upload('photo')) {
                        $data = $this->upload->data();
                        $image_path = $data['raw_name'] . $data['file_ext'];
                        $formArray['photo'] = $image_path;
                    }
                    $formArray['firstname'] = $this->input->post('firstname');
                    $formArray['lastname'] = $this->input->post('lastname');
                    $formArray['gender'] = $this->input->post('gender');
                    $formArray['phone'] = $this->input->post('phone');
                    $formArray['email'] = $this->input->post('email');
                    $formArray['birthdate'] = $this->input->post('birthdate');
                    $formArray['country'] = $this->input->post('country');
                    $formArray['city'] = $this->input->post('city');
                    $formArray['address'] = $this->input->post('address');
                    $formArray['created_at'] = date('Y-m-d');
                    $this->Customer_model->create($formArray);
                    $this->session->set_flashdata('success', 'Records added successfully!'); //Message will be shown once after record insertion
                    redirect('customer', 'referesh');
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
            $customer = $this->Customer_model->getCustomer($id);
            $data['customer'] = $customer;
            $data['title'] = "Edit a customer";
            $data['page_name'] = 'editcustomer/editcustomer';
            if ($this->input->post()) {
                $this->form_validation->set_rules('firstname', 'First Name', 'required');
                $this->form_validation->set_rules('lastname', 'Last Name', 'required');
                $this->form_validation->set_rules('gender', ' Gender', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('birthdate', ' Date of Birth', 'required');
                $this->form_validation->set_rules('country', 'Country', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                if ($this->form_validation->run() === TRUE) {
                    $formArray = array();
                    // Update product
                    if (!empty($_FILES['photo']['size']) && $_FILES['photo']['name'] != $customer['photo']) {
                        // echo '<pre>';
                        // print_r($_FILES);
                        $config = [
                            'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/crudinci3/public/images/customer/',
                            'allowed_types' => 'gif|jpg|png|jpeg',
                        ];
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $this->upload->do_upload('photo');
                        $data = $this->upload->data();
                        $image_path = $data['raw_name'] . $data['file_ext'];
                        $file_name = $config['upload_path'] .  $customer['photo'];
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
                    $formArray['firstname'] = $this->input->post('firstname');
                    $formArray['lastname'] = $this->input->post('lastname');
                    $formArray['gender'] = $this->input->post('gender');
                    $formArray['phone'] = $this->input->post('phone');
                    $formArray['email'] = $this->input->post('email');
                    $formArray['birthdate'] = $this->input->post('birthdate');
                    $formArray['country'] = $this->input->post('country');
                    $formArray['city'] = $this->input->post('city');
                    $formArray['address'] = $this->input->post('address');
                    $formArray['created_at'] = date('Y-m-d');
                    $this->Customer_model->updateCustomer($formArray, $id);
                    $this->session->set_flashdata('success', 'Records updated successfully!');
                    redirect('customer', 'referesh');
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
            $customer = $this->Customer_model->getCustomer($id);
            if (empty($customer)) {
                $this->session->set_flashdata('failure', 'Record not found.');
                redirect('product', 'referesh');
            } else {
                $formArray = array();
                $formArray['is_deleted'] = 1;
                $this->Customer_model->updateCustomer($formArray, $id);
                $this->session->set_flashdata('success', 'Records deleted successfully!');
                redirect('customer', 'referesh');
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
