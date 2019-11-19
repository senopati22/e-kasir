<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login")
        {
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
        }

        $this->load->helper('short_number');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        $this->load->view("admin/overview");
    }
}