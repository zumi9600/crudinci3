<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Refund extends CI_Controller
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
            $data['title'] = "Refund";
            $data['page_name'] = 'refund/refund';
            $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function getInvoice()
    {
        $invoice_id = $this->input->post('id', True);
        $data = $this->Sale_model->getSale($invoice_id);
        echo json_encode($data);
    }
    public function getProductsByInvoiceId()
    {
        $invoice_id = $this->input->post('id', True);
        $products = $this->Sale_model->getProductsBySaleId($invoice_id);
        echo json_encode($products);
    }
    public function refundItem()
    {
        if ($this->ion_auth->logged_in()) {
            // $data['title'] = "Add a brand";
            // $data['page_name'] = 'addbrand/addbrand';
            // Validate Records
            $formArray = array();
            $sale_items = array();
            $sale_amount = $this->input->post('sale_amount');
            $sale_amount_paid =  $this->input->post('sale_amount_paid');
            $balance = $sale_amount - $sale_amount_paid;
            $productDetails =  $this->input->post('saleDetails');
            $actual_sale_id = $this->input->post('actual_sale_id');
            $products = count($productDetails);
            $formArray['customer_id'] = $this->input->post('customer_id');
            $formArray['sale_amount'] = $sale_amount;
            $formArray['sale_quantity'] = $this->input->post('sale_quantity');
            $formArray['sale_amount_paid'] = $sale_amount_paid;
            $formArray['balance'] = $balance;
            $formArray['sold_by'] = $this->input->post('sold_by');
            $formArray['time_created'] = date('Y-m-d H:i:s');
            $formArray['sale_status'] = 'refunded';
            $formArray['actual_sale_id'] = $actual_sale_id;
            // echo "<pre>";
            // print_r($sale_items);
            // print_r($productDetails);
            // exit;
            $sale_id = $this->Sale_model->createSales($formArray);
            for ($i = 0; $i < $products; $i++) {

                $sale_items[$i]['product_id'] = $productDetails[$i]['product_id'];
                $sale_items[$i]['product_quantity'] = $productDetails[$i]['product_quantity'];
                $sale_items[$i]['product_price'] = $productDetails[$i]['product_price'];
                $sale_items[$i]['sale_id'] = $sale_id;
            }
            $this->Sale_model->insertSaleItems($sale_items);
            // exit;
            // $this->Brand_model->create($formArray); //call create function and passing data(array) in model
            //     $this->session->set_flashdata('success', 'Record added successfully!'); //Message will be shown once after record insertion


            // $this->load->view('index', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    // public function list()
    // {
    //     if ($this->ion_auth->logged_in()) {
    //         $user = $this->Ion_auth_model->user()->row();
    //         $sales = $this->Sale_model->list();
    //         $data['title'] = "Sales List";
    //         $data['user'] = $user;
    //         $data['sales'] = $sales;

    //         // echo '<pre>';
    //         // foreach ($sales as $sale) {
    //         //     print_r($sale);
    //         // }
    //         // exit;
    //         $data['page_name'] = 'salelist/salelist';
    //         $this->load->view('index', $data);
    //     } else {
    //         redirect('auth/login', 'refresh');
    //     }
    // }
    // public function invoice($id)
    // {
    //     if ($this->ion_auth->logged_in()) {
    //         // $user = $this->Ion_auth_model->user()->row();
    //         // $sales = $this->Sale_model->list();
    //         $sales = $this->Sale_model->getSale($id);
    //         $products = $this->Sale_model->getProductsBySaleId($id);
    //         $data['title'] = "Invoice";
    //         $data['sales'] = $sales;
    //         $data['products'] = $products;
    //         // echo '<pre>';
    //         // print_r($sales);
    //         // print_r($products);
    //         // exit;

    //         // $data['user'] = $user;
    //         // $data['sales'] = $sales;
    //         // echo '<pre>';
    //         // foreach ($sales as $sale) {
    //         //     print_r($sale);
    //         // }
    //         // exit;
    //         $page_name = 'printinvoice/printinvoice';
    //         // <?php echo include(APPPATH . 'views/' . $page_name . '.php'); 
    //         // $print_invoice = include(APPPATH . 'views/' . $page_name . '.php',$data);

    //         $this->load->view($page_name . '.php', $data);
    //     } else {
    //         redirect('auth/login', 'refresh');
    //     }
    // }
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
