<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('peringatan_login', 'Akses anda ditolak!. Silahkan login terlebih dahulu');
			redirect(base_url("login")); 
		}
        $this->load->model("user_model");
        $this->load->model("m_userpassword");
        $this->load->library('form_validation');
        $this->load->helper('short_number');
        $this->load->helper('indonesian_date');
    }

    public function index()
    {
        if ($this->session->userdata('level') != "Admin")
        {
            $this->session->set_flashdata('aksestolak', 'Akses anda ditolak!. Karena Anda bukan admin');
            redirect(base_url("admin"));
        }
        
        $data['users'] = $this->user_model->getAll();
        $this->load->view("admin/user/list_u", $data);
    }

    public function add()
    {
        if ($this->session->userdata('level') != "Admin")
        {
            $this->session->set_flashdata('aksestolak', 'Akses anda ditolak!. Karena Anda bukan admin');
            redirect(base_url("admin"));
        }
        
        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $post = $this->input->post();
            $uname = $post['uname'];
            $qq = $this->db->query("SELECT * from admin where uname = '$uname'")->row();

            if($qq <= "")
            {
                $user->save();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
        }

        $this->load->view("admin/user/new_form_u");
    }

    public function edit($id = null)
    {
        if ($this->session->userdata('level') != "Admin")
        {
            $this->session->set_flashdata('aksestolak', 'Akses anda ditolak!. Karena Anda bukan admin');
            redirect(base_url("admin"));
        }
        
        if (!isset($id)) redirect('admin/users');
       
        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $post = $this->input->post();
            $uname = $post['uname'];
            $qw = $this->db->query("SELECT * from admin where uname = '$uname'")->row();

            if($qw <= "")
            {
                $user->update();
                $this->session->set_flashdata('success', '<i class="fa fa-check"></i> Alhamdulillah, Data berhasil disimpan');
            }
            else
            {
                $this->session->set_flashdata('error', '<i class="fa fa-check"></i> Nama sudah ada');
            }
        }

        $data["user"] = $user->getById($id);
        if (!$data["user"]) show_404();
        
        $this->load->view("admin/user/edit_form_u", $data);
    }

    public function editpassword($id = null)
    {
        if (!isset($id)) redirect('admin/users');

        $passwordlama = md5($this->input->post('passwordlama'));
        $pws          = $this->session->userdata('oldpass');

        $userpas = $this->m_userpassword;
        $validation = $this->form_validation;
        $validation->set_rules($userpas->rules());

        if ($validation->run())
        {
            if ($passwordlama == $pws)
            {
                $userpas->update();
                $this->session->set_flashdata('successpass', '<i class="fa fa-check"></i> Alhamdulillah, Password telah diganti');
            }
            else
            {
                $this->session->set_flashdata('gagalpass', '<i class="fa fa-times"></i> Gagal');
            }
        }

        $data["userpas"] = $this->m_userpassword->getById($id);
        if (!$data["userpas"]) show_404();
        $this->load->view("admin/user/edit_form_up", $data);
    }

    public function delete($id=null)
    {
        if ($this->session->userdata('level') != "Admin")
        {
            $this->session->set_flashdata('aksestolak', 'Akses anda ditolak!. Karena Anda bukan admin');
            redirect(base_url("admin"));
        }
        
        if (!isset($id)) show_404();
        
        if ($this->user_model->delete($id)) {
            redirect(site_url('admin/users'));
        }
    }
}
