<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
		}

        $this->load->model("m_supplier");
        $this->load->library('form_validation');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        $data["supplier"] = $this->m_supplier->getAll();
        $this->load->view("admin/supplier/list_supplier", $data);
    }

    public function add()
    {
        $supplier = $this->m_supplier;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run())
        {
            $post = $this->input->post();
            $nama     = $post['nama'];

            $qq = $this->db->query("SELECT namasp from supplier where namasp = '$nama'")->row();

            if($qq <= "")
            {
                $supplier->save();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
            
        }

        $this->load->view("admin/supplier/new_form_supplier");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/supplier');
       
        $supplier = $this->m_supplier;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run()) {
            $post = $this->input->post();
            $nama     = $post['nama'];

            $qq = $this->db->query("SELECT namasp from supplier where namasp = '$nama'")->row();

            if($qq <= "")
            {
                $supplier->update();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
        }

        $data["supplier"] = $supplier->getById($id);
        if (!$data["supplier"]) show_404();

        $this->load->view("admin/supplier/edit_form_supplier", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->m_supplier->delete($id)) {
            redirect(site_url('admin/supplier'));
        }
    }
}