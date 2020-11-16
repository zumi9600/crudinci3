<?php
class Subcategory_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('subcategories', $formArray); // INSERT INTO products(name,price,quantity, category,subcategory) values(?,?,?,?)

    }
    function list()
    {
        $this->db->select('brands.name as brand_name,categories.name as category_name,subcategories.*');
        $this->db->from('subcategories');
        $this->db->join('categories', 'subcategories.category=categories.id');
        $this->db->join('brands', 'subcategories.brand=brands.id');
        $query = $this->db->get();
        return $result = $query->result_array(); //SELECT * from products
    }
    function getSubcategory($id)
    {
        $this->db->where('id', $id);
        return $subcategory = $this->db->get('subcategories')->row_array();
    }

    function updateSubcategory($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('subcategories', $formArray);
    }
    function deleteSubcategory($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('subcategories');
    }
    function getCategoryByBrand($brand_id)
    {
        $this->db->where('categories.brand', $brand_id);
        return $category = $this->db->get_where('categories')->result_array();
        return $category;
    }
    function getSubcategoryByCategory($category_id)
    {
        $this->db->where('subcategories.category', $category_id);
        return $subcategory = $this->db->get_where('subcategories')->result_array();
        return $subcategory;
    }
}
