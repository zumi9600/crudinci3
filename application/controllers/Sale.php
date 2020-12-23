<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
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
        $this->load->model('Customer_model');
        $this->load->model('Sale_model');
        $this->load->model('Ion_auth_model');
        $this->load->library('email');
    }
    public function index()
    {
        if ($this->ion_auth->logged_in()) {

            $user = $this->Ion_auth_model->user()->row();
            $user_id = $this->Ion_auth_model->user()->row()->id;
            $products = $this->Product_model->list();
            $customers = $this->Customer_model->list();
            $data = array();
            $data['user'] = $user;
            $data['customers'] = $customers;
            $data['products'] = $products;
            $data['user_id'] = $user_id;
            $data['title'] = "Sales";
            $data['page_name'] = 'sale/sale';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function create()
    {
        if ($this->ion_auth->logged_in()) {
            // $data['title'] = "Add a brand";
            // $data['page_name'] = 'addbrand/addbrand';
            // Validate Records
            $formArray = array();
            $productArray = array();
            $sale_items = array();
            $sale_amount = $this->input->post('sale_amount');
            $sale_amount_paid =  $this->input->post('sale_amount_paid');
            $balance = $sale_amount - $sale_amount_paid;
            $productDetails =  $this->input->post('saleDetails');
            $products = count($productDetails);
            $formArray['customer_id'] = $this->input->post('customer_id');
            $formArray['sale_amount'] = $sale_amount;
            $formArray['sale_quantity'] = $this->input->post('sale_quantity');
            $formArray['sale_amount_paid'] = $sale_amount_paid;
            $formArray['balance'] = $balance;
            $formArray['sold_by'] = $this->input->post('sold_by');
            $formArray['time_created'] = date('Y-m-d H:i:s');
            $sale_id = $this->Sale_model->createSales($formArray);
            for ($i = 0; $i < $products; $i++) {
                $id = $productDetails[$i]['id'];
                $product = $this->Product_model->getProduct($id);
                $product_actual_quantity = $product['quantity'];
                $sold_product_quantity = $productDetails[$i]['quantity'];
                $product_new_quantity = $product_actual_quantity - $sold_product_quantity;
                $productArray['quantity'] = $product_new_quantity;
                $this->Product_model->updateProduct($productArray, $id);
                $sale_items[$i]['product_id'] = $productDetails[$i]['id'];
                $sale_items[$i]['product_quantity'] = $productDetails[$i]['quantity'];
                $sale_items[$i]['product_price'] = $productDetails[$i]['price'];
                $sale_items[$i]['sale_id'] = $sale_id;
            }
            $this->Sale_model->insertSaleItems($sale_items);

            // Email Details 
            $sales = $this->Sale_model->getSale($sale_id);
            $products = $this->Sale_model->getProductsBySaleId($sale_id);
            $user_email = $this->Ion_auth_model->user()->row()->email;
            $customer_email = $sales[0]['customer_email'];
            $invoice_id = $sales[0]['id'];
            $data['sales'] = $sales;
            $data['products'] = $products;
            $to = $customer_email;
            $subject = " Invoice ID # " . $invoice_id;
            $page_name = 'email/email';
            $body = $this->load->view($page_name . '.php', $data, TRUE);

            echo "<pre>";
            print_r($user_email);
            // print_r($body);
            // Intizializing email library
            // $this->email->initialize($config);
            // $this->email->set_newline("\r\n");

            $this->email->from($user_email);
            $this->email->to($to); // replace it with receiver mail id
            $this->email->subject($subject); // replace it with relevant subject
            $this->email->message($body);
            $this->email->send();
            echo $this->email->print_debugger();

            // print_r($sale_items);
            // exit;
            // $this->Brand_model->create($formArray); //call create function and passing data(array) in model
            //     $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion


            // $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function list()
    {
        if ($this->ion_auth->logged_in()) {
            $user = $this->Ion_auth_model->user()->row();
            $sales = $this->Sale_model->list();
            // $sales_total = $this->Sale_model->saleSum();
            $sales_total = $this->Sale_model->saleSum();
            $sale_months = $this->Sale_model->getMonth();
            echo '<pre>';
            // foreach ($sales as $sale) {
            print_r($sale_months);
            // }
            exit;
            // foreach ($sales as $sale) {
            //     $sales_total_quantity = $sale['sale_quantity'];
            //     $sales_total_amount = $sale['sale_amount'];
            // }
            $data['sale_total_amount'] = $sales_total['sale_total_amount'];
            $data['sale_total_quantity'] = $sales_total['sale_total_quantity'];
            $data['total_sales'] = $sales_total['total_sales'];
            $data['title'] = "Sales List";
            $data['user'] = $user;
            $data['sales'] = $sales;

            $data['page_name'] = 'salelist/salelist';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function invoice($id)
    {
        if ($this->ion_auth->logged_in()) {
            // $user = $this->Ion_auth_model->user()->row();
            // $sales = $this->Sale_model->list();
            $sales = $this->Sale_model->getSale($id);
            $products = $this->Sale_model->getProductsBySaleId($id);
            $data['title'] = "Invoice";
            $data['sales'] = $sales;
            $data['products'] = $products;
            // echo '<pre>';
            // print_r($sales);
            // print_r($products);
            // exit;

            // $data['user'] = $user;
            // $data['sales'] = $sales;
            // echo '<pre>';
            // foreach ($sales as $sale) {
            //     print_r($sale);
            // }
            // exit;
            $page_name = 'printinvoice/printinvoice';
            $this->load->view($page_name . '.php', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    // public function edit($id)
    // {
    //     if ($this->ion_auth->logged_in()) {
    //         $brand = $this->Brand_model->getBrand($id);
    //         $data = array();
    //         $data['brand'] = $brand;
    //         $data['title'] = "Edit a brand";
    //         $data['page_name'] = 'editbrand/editbrand';
    //         //Validate records
    //         $this->form_validation->set_rules('name', ' Name', 'required');
    //         if ($this->form_validation->run() === TRUE) {
    //             // Update product
    //             $formArray = array();
    //             $formArray['name'] = $this->input->post('name');
    //             $this->Brand_model->updateBrand($formArray, $id);
    //             $this->session->set_flashdata('success', 'Record updated successfully!');
    //             redirect('brand', 'referesh');
    //         } else {
    //             $this->load->view('index', $data);
    //         }
    //     } else {
    //         redirect('auth/login', 'refresh');
    //     }
    // }
    // public function delete($id)
    // {
    //     if ($this->ion_auth->logged_in()) {
    //         $brand = $this->Brand_model->getBrand($id);
    //         if (empty($brand)) {
    //             $this->session->set_flashdata('failure', 'Record not found.');
    //             redirect('brand', 'referesh');
    //         } else {
    //             $formArray = array();
    //             $formArray['is_deleted'] = 1;
    //             $this->Brand_model->updateBrand($formArray, $id);
    //             $this->session->set_flashdata('success', 'Record deleted successfully!');
    //             redirect('brand', 'referesh');
    //         }
    //     } else {
    //         redirect('auth/login', 'refresh');
    //     }
    // }
}
