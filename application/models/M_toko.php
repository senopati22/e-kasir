<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_toko extends CI_Model
{
    private $_table  = "toko";

    public $idtoko;
    public $site_name;
    public $alamat;
    public $kota;
    public $prov;
    public $telp;
    public $foto = "default.png";

    public function rules()
    {
        return [
            ['field' => 'site_name',
            'label' => 'Nama Toko',
            'rules' => 'required'],
        ];
    }

    // public function saveimage()
    // {
    //     $post = $this->input->post();
    //     $idtoko       = $post['idtoko'];
    //     $site_name    = $post['site_name'];
    //     $alamat       = $post['alamat'];
    //     $kota         = $post['kota'];
    //     $prov         = $post['prov'];
    //     $telp         = $post['telp'];
    //     $upfile       = $this->_uploadImage();
    //     $judul              = $post['judul'];

    //     $this->db->query("INSERT into foto (idtp4d, upfile, judul) values ('$idtp4d', '$upfile', '$judul')");
    // }

    public function update()
    {
        $post = $this->input->post();
        $this->idtoko       = $post['idtoko'];
        $this->site_name    = strtoupper($post['site_name']);
        $this->alamat       = ucwords($post['alamat']);
        $this->kota         = ucwords($post['kota']);
        $this->prov         = ucwords($post['prov']);
        $this->telp         = $post['telp'];

        if (!empty($_FILES["foto"]["name"]))
        {
            $this->foto = $this->_uploadImage();
            
        }
        else
        {
            $this->foto = $post['foto1'];
        }
        

        $cek = $this->db->update($this->_table, $this, array('idtoko' => $post['idtoko']));
        if ($cek === TRUE)
        {
            $this->session->sess_destroy();
            redirect(base_url('login'));
        }
    }
	
    private function _uploadImage()
	{
        $post = $this->input->post();

		$config['upload_path']          = './upload/logotoko/';
		$config['allowed_types']        = 'png';
		$config['file_name']            = $this->site_name;
		$config['overwrite']			= true;
		$config['max_size']             = 50024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			return $this->upload->data("file_name");
		}
		
		return "default.png";
	}

}