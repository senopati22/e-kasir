<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_laku extends CI_Controller
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
        $this->load->library('pdf1');
        $this->load->library('form_validation');
        $this->load->helper('short_number');
        $this->load->helper('indonesian_date');
    }

	private function konv_uang($angka)
    {
        $jadi = str_replace(".","",$angka);
        return $jadi;
    }

    public function index()
    {
        $data["barang_lakus"] = $this->m_barang_laku->getAll();
        $this->load->view("admin/barang_laku/list_barang_laku", $data);
    }

    public function cari()
    {
        $nama = $_GET['nama'];
        $cari = $this->m_barang_laku->cari($nama)->result();
        echo json_encode($cari);
    }

    public function add()
    {
        $barang_laku = $this->m_barang_laku;
        $validation = $this->form_validation;
        $validation->set_rules($barang_laku->rules());

        if ($validation->run())
        {
            $post = $this->input->post();
            $nama = $post['nama'];
            $jumlah = $this->konv_uang($post['jumlah']);

            $qq = $this->db->query("SELECT jumlah from barang where nama = '$nama'")->row();

            if($jumlah > $qq->jumlah)
            {
                $this->session->set_flashdata('error', '<i class="fas fa-exclamation-triangle"></i> Maaf, Stok barang tidak mencukupi!');
            }
            else
            {
                $barang_laku->save();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
        }

        $this->load->view("admin/barang_laku/new_form_barang_laku");
    }

    public function PrintBarang_laku()
    {
        $data["barang"] = $this->m_barang_laku->getAll();
        $this->load->view("admin/_partials/barang_laku/print", $data);
    }

    // public function edit($id = null)
    // {
    //     if (!isset($id)) redirect('admin/barang_laku');
       
    //     $barang_laku = $this->m_barang_laku;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($barang_laku->rules());

    //     if ($validation->run()) {
    //         $barang_laku->update();
    //         $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil diupdate');
    //     }

    //     $data["barang_laku"] = $barang_laku->getById($id);
    //     if (!$data["barang_laku"]) show_404();
        
    //     $this->load->view("admin/barang_laku/edit_form_barang_laku", $data);
    // }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->m_barang_laku->delete($id)) {
            redirect(site_url('admin/barang_laku'));
        }
    }
}
