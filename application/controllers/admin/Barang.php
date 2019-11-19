<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login")
        {
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
        }
        
        $this->load->model("m_barang");
        $this->load->library('pdf1');
        $this->load->library('form_validation');
        $this->load->helper('short_number');
        $this->load->helper('indonesian_date');
    }

    public function cari()
    {
        $idsupplier = $_GET['idsupplier'];
        $cari = $this->m_barang->cari($idsupplier)->result();
        echo json_encode($cari);
    }

    public function index()
    {
        $data["barang"] = $this->m_barang->getAll();
        $this->load->view("admin/barang/list_barang", $data);
    }

    public function All()
    {
        $data["barang"] = $this->m_barang->getAll();
        $this->load->view("admin/barang/list_barang_all", $data);
    }

    public function PrintBarang()
    {
        $data["barang"] = $this->m_barang->getAll();
        $this->load->view("admin/_partials/barang/print", $data);
    }

    public function add()
    {
        $barang = $this->m_barang;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run())
        {
            $post   = $this->input->post();
            $nama   = $post['nama'];

            $qq = $this->db->query("SELECT * from barang where nama = '$nama'")->row();

            if($qq <= "")
            {
                $barang->save();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
        }

        $this->load->view("admin/barang/new_form_barang");
    }

    // public function addimage()
    // {
    //     $barang1 = $this->m_barang;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($barang1->rules1());

    //     if ($validation->run()) {
    //         $barang1->saveimage();
    //         $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
    //     }

    //     $this->load->view("admin/barang/new_form_barang_image");
    // }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/barang');
       
        $barang = $this->m_barang;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run()) {
            $barang->update();
            $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil diupdate');
        }

        $data["barang"] = $barang->getById($id);
        if (!$data["barang"]) show_404();
        
        $this->load->view("admin/barang/edit_form_barang", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->m_barang->delete($id))
        {
            redirect(site_url('admin/barang'));
        }
    }

    // public function deleteimage($id=null)
    // {
    //     if (!isset($id)) redirect('admin/barang');
       
    //     $barang = $this->m_barang;
    //     $data["barang"] = $barang->getById($id);
    //     if (!$data["barang"]) show_404();
        
    //     $this->load->view("admin/barang/delete_form_barang_image", $data);
    // }

    // public function deleteimg($id=null)
    // {
    //     if (!isset($id)) show_404();
        
    //     if ($this->m_barang->deleteimage($id)) {
    //         redirect(site_url('admin/barang/all'));
    //     }
    // }
}
