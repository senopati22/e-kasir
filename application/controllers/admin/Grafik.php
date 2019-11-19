<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
		}
        $this->load->model("m_barang_laku");
        $this->load->library('form_validation');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        $data["barang_laku"] = $this->m_barang_laku->getAll();
        $this->load->view("admin/grafik", $data);
    }
}