<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login")
        {
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
        }
        
        $this->load->model("m_toko");
        $this->load->library('form_validation');
        $this->load->helper('short_number');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        $toko = $this->m_toko;
        $validation = $this->form_validation;
        $validation->set_rules($toko->rules());

        if ($validation->run()) {
            $toko->update();
            $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
        }

        $this->load->view("admin/toko/edit_form_toko");

        // $data["toko"] = $this->m_barang->getAll();
        // $this->load->view("admin/toko/edit_form_toko", $data);
    }
}
