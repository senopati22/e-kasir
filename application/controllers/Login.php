<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('m_login');
    }

    function index()
    {
        $this->load->view('v_login');
    }

    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where    = array(
            'uname' => $username,
            'pass' => md5($password)
        );
        $cek = $this->m_login->cek_login("admin", $where)->num_rows();

        if($cek > 0)
        {

            $result = $this->m_login->get_AfterLogin("admin",$where)->result();
            foreach ($result as $us)
            {
                $data_session = array(
                    // DATA TOKO
                    'idtoko'        => $us->idtoko,
                    'site_name'     => $us->site_name,
                    'alamat'        => $us->alamat,
                    'kota'          => $us->kota,
                    'prov'          => $us->prov,
                    'telp'          => $us->telp,
                    'foto'          => $us->foto,

                    // DATA LOGIN
                    'uname'         => $us->uname,
                    'level'         => $us->status,
                    'status'        => 'login'
                );
            }

            $this->session->set_userdata($data_session);
            redirect(base_url("admin/overview"));
        }
        
        else
        {
            $this->session->set_flashdata('gagal', '<p style="font-size: 12px;"><i class="fa fa-exclamation-triangle"></i> Username or password didn\'t match.</p>');
            redirect(base_url("login"));
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}