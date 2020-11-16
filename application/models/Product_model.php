<?php
class Product_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('products', $formArray); // INSERT INTO products(name,price,quantity, category,subcategory) values(?,?,?,?)

    }
    function list()
    {
        $this->db->select('brands.name as brand_name,categories.name as category_name,subcategories.name as subcategory_name,products.*');
        $this->db->from('products');
        $this->db->join('subcategories', 'products.subcategory=subcategories.id');
        $this->db->join('categories', 'products.category=categories.id');
        $this->db->join('brands', 'products.brand=brands.id');
        $query = $this->db->get();
        return $result = $query->result_array(); //SELECT * from products
    }
    function getProduct($id)
    {
        $this->db->where('id', $id);
        return $product = $this->db->get('products')->row_array();
    }
    function updateProduct($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('products', $formArray);
    }
    function deleteProduct($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products');
    }
}
