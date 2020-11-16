<?php
class Category_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('categories', $formArray); // INSERT INTO products(name,price,quantity, category,subcategory) values(?,?,?,?)

    }
    function list()
    {
        $this->db->select('brands.name as brand_name,categories.*');
        $this->db->from('categories');
        $this->db->join('brands', 'categories.brand=brands.id');
        $query = $this->db->get();
        return $result = $query->result_array(); //SELECT * from products
    }
    function getCategory($id)
    {
        $this->db->where('id', $id);
        return $category = $this->db->get('categories')->row_array();
    }
    function updateCategory($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $formArray);
    }
    function deleteCategory($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }
}
