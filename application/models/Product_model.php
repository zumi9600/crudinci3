<?php
class Product_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('products', $formArray);
        return $this->db->insert_id(); // INSERT INTO products(name,price,quantity, category,subcategory) values(?,?,?,?)
    }
    function multipleImages($image_name)
    {
        $this->db->insert_batch('photos', $image_name);
    }
    function list()
    {
        $this->db->select('brands.name as brand_name,categories.name as category_name,subcategories.name as subcategory_name,products.*');
        $this->db->from('products');
        $this->db->where('products.is_deleted=0');
        $this->db->join('subcategories', 'products.subcategory=subcategories.id');
        $this->db->join('categories', 'products.category=categories.id');
        $this->db->join('brands', 'products.brand=brands.id');
        $this->db->order_by('products.id', 'asc');
        $query = $this->db->get();
        return $result = $query->result_array(); //SELECT * from products
    }
    function getProduct($id)
    {
        $this->db->where('id', $id);
        return $product = $this->db->get('products')->row_array();
    }
    function getPhotoById($id)
    {
        $this->db->where('id', $id);
        return $photos = $this->db->get('photos')->row_array();
    }
    function photoByProductId($id)
    {
        $this->db->where('product', $id and 'is_deleted=0');
        return $product = $this->db->get('photos')->result_array();
    }
    function updateProduct($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('products', $formArray);
    }
    function updatePhotos($photos, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('photos', $photos);
    }
    // function deleteProduct($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('products');
    // }
    // function deletePhotoByProductId($id)
    // {
    //     $this->db->where('photos.product', $id);
    //     $this->db->delete('photos');
    // }
    // function deletePhoto($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('photos');
    // }
}
