<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function get_all_orders() {
        $this->db->select('orders.*, products.name as product_name');
        $this->db->from('orders');
        $this->db->join('products', 'orders.product_id = products.id');
        $this->db->order_by('orders.order_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_orders_by_product($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->order_by('order_date', 'DESC');
        $query = $this->db->get('orders');
        return $query->result();
    }

    public function insert_order($data) {
        return $this->db->insert('orders', $data);
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('orders', array('status' => $status));
    }

    public function count_orders() {
        return $this->db->count_all('orders');
    }

    public function sum_revenue() {
        $this->db->select_sum('total_price');
        $query = $this->db->get('orders');
        $result = $query->row();
        return $result->total_price ? $result->total_price : 0;
    }

    public function count_today_orders() {
        $this->db->where('DATE(order_date)', date('Y-m-d'));
        $this->db->from('orders');
        return $this->db->count_all_results();
    }

    public function count_by_status($status) {
        $this->db->where('status', $status);
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
}
