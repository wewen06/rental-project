<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        // USER TIDAK PERLU LOGIN UNTUK AKSES BOOKING
    }

    public function index() {
        $data['title'] = 'Booking - LuxRent';
        $data['products'] = $this->Product_model->get_all_products();
        
        $product_id = $this->input->get('product_id');
        if ($product_id) {
            $data['selected_product'] = $this->Product_model->get_product_by_id($product_id);
        } else {
            $data['selected_product'] = null;
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('booking/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function process() {
        $this->form_validation->set_rules('product_id', 'Product', 'required');
        $this->form_validation->set_rules('customer_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('customer_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('customer_phone', 'No. Telepon', 'required');
        $this->form_validation->set_rules('days', 'Durasi', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('total_price', 'Total Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('booking');
        } else {
            $data = array(
                'product_id' => $this->input->post('product_id'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_phone' => $this->input->post('customer_phone'),
                'days' => $this->input->post('days'),
                'start_date' => $this->input->post('start_date'),
                'total_price' => $this->input->post('total_price'),
                'status' => 'pending'
            );

            if ($this->Order_model->insert_order($data)) {
                $this->session->set_flashdata('success', '✅ Pesanan berhasil disimpan! Kami akan menghubungi Anda segera.');
                redirect('booking');
            } else {
                $this->session->set_flashdata('error', '❌ Gagal menyimpan pesanan. Silakan coba lagi.');
                redirect('booking');
            }
        }
    }
}
