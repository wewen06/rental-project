<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_all_products() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('products');
        return $query->result();
    }

    public function get_product_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row();
    }

    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    // ========== UPDATE PRODUK ==========
    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function count_products() {
        return $this->db->count_all('products');
    }
}
