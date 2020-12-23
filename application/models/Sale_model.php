<?php
class Sale_model extends CI_Model
{
    function createSales($formArray)
    {
        $this->db->insert('sales', $formArray);
        return $this->db->insert_id();
    }
    function insertSaleItems($sale_items)
    {
        $this->db->insert_batch('sales_item', $sale_items);
    }
    function list()
    {
        // Listing Records which are not soft deleted
        // $this->db->where('sales.id', $id);
        $this->db->select('users.first_name as user_first_name,users.last_name as user_last_name,customers.firstname as customer_first_name, customers.lastname as customer_last_name,sales.*');
        $this->db->from('sales');
        $this->db->join('users', 'sales.sold_by=users.id');
        $this->db->join('customers', 'sales.customer_id=customers.id');
        // $this->db->join('products', 'sales_item.product_id=products.id');
        // $this->db->where('categories.is_deleted', 0);
        $query = $this->db->get();
        return $result = $query->result_array();
        // return $this->db->get('sales')->result_array(); //SELECT * from products
    }
    function getSale($id)
    {
        // Listing Records which are not soft deleted
        $this->db->where('sales.id', $id);
        $this->db->select('customers.email as customer_email,customers.firstname as customer_first_name, customers.lastname as customer_last_name,users.first_name as user_first_name,users.last_name as user_last_name,users.email as user_email,customers.*,sales.*');
        $this->db->from('sales');
        $this->db->join('users', 'sales.sold_by=users.id');
        $this->db->join('customers', 'sales.customer_id=customers.id');
        // $this->db->join('products', 'sales_item.product_id=products.id');
        // $this->db->where('categories.is_deleted', 0);
        $query = $this->db->get();
        return $result = $query->result_array();
        // return $this->db->get('sales')->result_array(); //SELECT * from products
    }
    function getProductsBySaleId($id)
    {
        $this->db->where('sales_item.sale_id', $id);
        $this->db->select('products.name as product_name,products.price as actual_price,sales_item.*');
        $this->db->from('sales_item');
        $this->db->join('sales', 'sales.id=sales_item.sale_id');
        $this->db->join('products', 'sales_item.product_id=products.id');
        // $this->db->group_by('sale_id');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    function saleSum()
    {
        $this->db->select('COUNT(id) as total_sales,SUM(sale_amount) AS sale_total_amount, SUM(sale_quantity) AS sale_total_quantity', FALSE);
        $query = $this->db->get('sales');
        return $query->row_array();
        echo $this->db->num_rows();
    }
    function getSalesPerMonth()
    {
        $this->db->select('DATE_FORMAT(time_created, "%m") as month,count(*) as num_of_sales');
        $this->db->group_by('DATE_FORMAT(time_created, "%m")');
        $query = $this->db->get('sales');
        return $query->result_array();
    }
    // function getMonthsName()
    // {
    //     $this->db->select('');
    //     $this->db->group_by('DATE_FORMAT(time_created, "%m")');
    //     $query = $this->db->get('sales');
    //     return $query->result_array();
    // }
    // function getBrand($id)
    // {
    //     $this->db->where('id', $id);
    //     return $brand = $this->db->get('brands')->row_array();
    // }
    // function updateBrand($formArray, $id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->update('sales', $formArray);
    // }
    // Hard Delete Function
    // function deleteBrand($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('brands');
    // }
}
