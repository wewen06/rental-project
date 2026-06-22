<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        // Jika sudah login, redirect ke home
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }
        
        $data['title'] = 'Login - LuxRent';
        $this->load->view('auth/login', $data);
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Username dan Password harus diisi!');
            redirect('auth');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // ========== DATA USER & ADMIN ==========
            // Data admin
            $admin_username = 'admin';
            $admin_password = '123456';
            
            // Data user biasa (bisa ditambah di database nanti)
            $user_username = 'user';
            $user_password = '123456';
            // ========================================

            // Cek login Admin
            if ($username == $admin_username && $password == $admin_password) {
                $session_data = array(
                    'username' => $username,
                    'role' => 'admin',
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                
                $this->session->set_flashdata('success', '✅ Login berhasil! Selamat datang, Admin.');
                redirect('admin');
            }
            // Cek login User Biasa
            elseif ($username == $user_username && $password == $user_password) {
                $session_data = array(
                    'username' => $username,
                    'role' => 'user',
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                
                $this->session->set_flashdata('success', '✅ Login berhasil! Selamat datang, ' . $username . '.');
                redirect('home');
            }
            // Login Gagal
            else {
                $this->session->set_flashdata('error', '❌ Username atau Password salah!');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', '✅ Anda berhasil logout.');
        redirect('auth');
    }
}
