<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang_laku extends CI_Model
{
    private $_table  = "barang_laku";

    public $tanggal;
    public $nama;
    public $harga;
    public $jumlah;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    function cari($id)
    {
        $query= $this->db->get_where('barang',array('nama'=>$id));
        return $query;
    }

    private function konv_uang($angka)
    {
        $jadi = str_replace(".","",$angka);
        return $jadi;
    }

    public function save()
    {
        $post = $this->input->post();

        $this->tanggal      = $post['tanggal'];
        $this->nama         = $post['nama'];
        $this->jumlah       = $this->konv_uang($post['jumlah']);

        /* ====== UPDATE DATA ======= */
        $qq = $this->db->query("SELECT * from barang where nama = '$this->nama'")->result();
        foreach($qq as $dt)
        {
            $pjml = $this->konv_uang($post['jumlah']);
            $sisa = $dt->jumlah;
            $jml = $sisa-$pjml;
            $this->db->query("UPDATE barang set jumlah = '$jml' where nama = '$this->nama'");

            $modal = $dt->modal;
            /* ====== SAVE DATA ======= */
            $this->harga        = $this->konv_uang($post['harga']);
            $hrg = $this->konv_uang($post['harga']);
            $this->total_harga  = $hrg*$pjml;
            $laba  = $hrg-$modal;
            $labaa = $laba*$pjml;
            $this->laba         = $labaa;

            $this->db->insert($this->_table, $this);
        }

        
    }

    // public function update()
    // {
    //     $post = $this->input->post();
    //     $this->idsatker     = $post["idsatker"];
    //     $this->nmsatker     = strtoupper($post["nmsatker"]);
    //     $this->alamat       = $post["alamat"];
    //     $this->tlp          = $post["tlp"];

    //     $this->db->update($this->_table, $this, array('idsatker' => $post['idsatker']));
    // }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

}
