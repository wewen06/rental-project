<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Cek login & role admin
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', '❌ Anda tidak memiliki akses ke halaman admin!');
            redirect('home');
        }
        
        $this->load->model('Product_model');
        $this->load->model('Order_model');
    }

    public function index() {
        $data['title'] = 'Admin Dashboard - LuxRent';
        $data['total_orders'] = $this->Order_model->count_orders();
        $data['total_revenue'] = $this->Order_model->sum_revenue();
        $data['today_orders'] = $this->Order_model->count_today_orders();
        $data['total_products'] = $this->Product_model->count_products();
        $data['orders'] = $this->Order_model->get_all_orders();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    public function products() {
        $data['title'] = 'Kelola Produk - LuxRent';
        $data['products'] = $this->Product_model->get_all_products();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/products', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add_product() {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products');
        } else {
            
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $file_name = time() . '_' . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $upload_ok = true;
            $error_message = '';
            
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                $upload_ok = false;
                $error_message = "File bukan gambar.";
            }
            
            if ($_FILES["image"]["size"] > 2000000) {
                $upload_ok = false;
                $error_message = "File terlalu besar. Maksimal 2MB.";
            }
            
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $upload_ok = false;
                $error_message = "Format file tidak didukung. Gunakan: JPG, JPEG, PNG, GIF, WEBP";
            }
            
            if ($upload_ok) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = 'uploads/' . $file_name;
                    
                    $data = array(
                        'name' => $this->input->post('name'),
                        'price_per_day' => $this->input->post('price'),
                        'image_url' => $image_url
                    );
                    
                    if ($this->Product_model->insert_product($data)) {
                        $this->session->set_flashdata('success', '✅ Produk berhasil ditambahkan!');
                    } else {
                        $this->session->set_flashdata('error', '❌ Gagal menyimpan ke database.');
                    }
                } else {
                    $this->session->set_flashdata('error', '❌ Gagal upload file.');
                }
            } else {
                $this->session->set_flashdata('error', '❌ ' . $error_message);
            }
            
            redirect('admin/products');
        }
    }

    public function edit_product($id) {
        $data['title'] = 'Edit Produk - LuxRent';
        $data['product'] = $this->Product_model->get_product_by_id($id);
        
        if (empty($data['product'])) {
            $this->session->set_flashdata('error', '❌ Produk tidak ditemukan!');
            redirect('admin/products');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_product', $data);
        $this->load->view('templates/footer', $data);
    }

    public function update_product($id) {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_product/' . $id);
        } else {
            
            $data = array(
                'name' => $this->input->post('name'),
                'price_per_day' => $this->input->post('price')
            );
            
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $file_name;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                $upload_ok = true;
                $error_message = '';
                
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    $upload_ok = false;
                    $error_message = "File bukan gambar.";
                }
                
                if ($_FILES["image"]["size"] > 2000000) {
                    $upload_ok = false;
                    $error_message = "File terlalu besar. Maksimal 2MB.";
                }
                
                if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $upload_ok = false;
                    $error_message = "Format file tidak didukung. Gunakan: JPG, JPEG, PNG, GIF, WEBP";
                }
                
                if ($upload_ok) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $old_product = $this->Product_model->get_product_by_id($id);
                        if ($old_product && !empty($old_product->image_url) && file_exists($old_product->image_url)) {
                            unlink($old_product->image_url);
                        }
                        
                        $data['image_url'] = 'uploads/' . $file_name;
                    } else {
                        $this->session->set_flashdata('error', '❌ Gagal upload file.');
                        redirect('admin/edit_product/' . $id);
                    }
                } else {
                    $this->session->set_flashdata('error', '❌ ' . $error_message);
                    redirect('admin/edit_product/' . $id);
                }
            }
            
            if ($this->Product_model->update_product($id, $data)) {
                $this->session->set_flashdata('success', '✅ Produk berhasil diupdate!');
            } else {
                $this->session->set_flashdata('error', '❌ Gagal mengupdate produk.');
            }
            
            redirect('admin/products');
        }
    }

    public function delete_product($id) {
        $product = $this->Product_model->get_product_by_id($id);
        if ($product && !empty($product->image_url) && file_exists($product->image_url)) {
            unlink($product->image_url);
        }
        
        if ($this->Product_model->delete_product($id)) {
            $this->session->set_flashdata('success', '✅ Produk berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', '❌ Gagal menghapus produk.');
        }
        redirect('admin/products');
    }

    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        if ($this->Order_model->update_status($id, $status)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    // ========== EKSPOR DATA KE CSV ==========
    public function export_data() {
        $this->load->model('Order_model');
        
        $orders = $this->Order_model->get_all_orders();
        
        $filename = 'laporan_pesanan_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($output, array(
            'ID Pesanan',
            'Pelanggan',
            'Email',
            'Telepon',
            'Produk',
            'Durasi (hari)',
            'Total Harga',
            'Status',
            'Tanggal Pemesanan',
            'Tanggal Mulai'
        ));
        
        $status_map = array(
            'pending' => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai'
        );
        
        foreach ($orders as $order) {
            fputcsv($output, array(
                $order->id,
                $order->customer_name,
                $order->customer_email,
                $order->customer_phone,
                $order->product_name,
                $order->days,
                $order->total_price,
                isset($status_map[$order->status]) ? $status_map[$order->status] : $order->status,
                date('d-m-Y H:i', strtotime($order->order_date)),
                !empty($order->start_date) ? date('d-m-Y', strtotime($order->start_date)) : '-'
            ));
        }
        
        fclose($output);
        exit;
    }
}
