<?php
class Brand_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('brands', $formArray); // INSERT INTO products(name,price,quantity, category,subcategory) values(?,?,?,?)

    }
    function list()
    {
        return $brands = $this->db->get('brands')->result_array(); //SELECT * from products
    }
    function getBrand($id)
    {
        $this->db->where('id', $id);
        return $brand = $this->db->get('brands')->row_array();
    }
    function updateBrand($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('brands', $formArray);
    }
    function deleteBrand($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('brands');
    }
}
