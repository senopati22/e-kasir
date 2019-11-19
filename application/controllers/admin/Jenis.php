<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login"));
		}

        $this->load->model("m_jenis");
        $this->load->library('form_validation');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        $data["jenis"] = $this->m_jenis->getAll();
        $this->load->view("admin/jenis/list_jenis", $data);
    }

    public function add()
    {
        $jenis = $this->m_jenis;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        if ($validation->run())
        {
            $post = $this->input->post();
            $nama     = $post['nama'];

            $qq = $this->db->query("SELECT namajns from jenis where namajns = '$nama'")->row();

            if($qq <= "")
            {
                $jenis->save();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
            
        }

        $this->load->view("admin/jenis/new_form_jenis");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/jenis');
       
        $jenis = $this->m_jenis;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        if ($validation->run()) {
            $post = $this->input->post();
            $nama = $post['nama'];

            $qq = $this->db->query("SELECT namajns from jenis where namajns = '$nama'")->row();

            if($qq <= "")
            {
                $jenis->update();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
        }

        $data["jenis"] = $jenis->getById($id);
        if (!$data["jenis"]) show_404();

        $this->load->view("admin/jenis/edit_form_jenis", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->m_jenis->delete($id)) {
            redirect(site_url('admin/jenis'));
        }
    }
}