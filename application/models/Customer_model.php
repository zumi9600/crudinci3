<?php
class Customer_model extends CI_Model
{
    function create($formArray)
    {
        $this->db->insert('customers', $formArray);
        // return $this->db->insert_id();
    }
    function list()
    {
        $this->db->where('is_deleted', 0);
        return $query = $this->db->get('customers')->result_array();
    }
    function getCustomer($id)
    {
        $this->db->where('id', $id);
        return $customer = $this->db->get('customers')->row_array();
    }
    function updateCustomer($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('customers', $formArray);
    }
}
