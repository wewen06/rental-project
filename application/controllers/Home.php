<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        // USER TIDAK PERLU LOGIN UNTUK AKSES HOME
    }

    public function index() {
        $data['title'] = 'LuxRent - Premium Equipment Rental';
        $data['products'] = $this->Product_model->get_all_products();
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
