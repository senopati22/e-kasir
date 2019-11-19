<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model
{
    private $_table  = "barang";

    public $id;
    public $idsupplier;
    public $idjenis;
    public $nama;
    public $modal;
    public $harga;
    public $jumlah;
    public $sisa;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->query("SELECT brg.*, jn.*, sp.* from barang brg
                        INNER JOIN jenis jn ON (brg.idjenis = jn.idjenis)
                        INNER JOIN supplier sp ON (brg.idsupplier = sp.idsupplier)")->result();
        //return $this->db->get($this->_table)->result();
    }

    function cari($id)
    {
        $query= $this->db->get_where('supplier', array('idsupplier'=>$id));
        return $query;
    }

    public function Jumlah()
    {
        $query = $this->db->query('SELECT COUNT(*) as jumlah from barang');
        return $query->result();
    }
    
    public function getById($id)
    {
        return $this->db->query("SELECT brg.*, jn.*, sp.* from barang brg
                        INNER JOIN jenis jn ON (brg.idjenis = jn.idjenis)
                        INNER JOIN supplier sp ON (brg.idsupplier = sp.idsupplier)
                        where id = '$id'")->row();
        //return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->idsupplier   = $post['idsupplier'];
        $this->idjenis      = $post['idjenis'];
        $this->nama         = ucwords($post['nama']);
        // $this->jenis        = ucfirst($post['jenis']);
        // $this->suplier      = strtoupper($post['suplier']);
        $this->modal        = $this->konv_uang($post['modal']);
        $this->harga        = $this->konv_uang($post['harga']);
        $this->jumlah       = $this->konv_uang($post['jumlah']);
        $this->sisa         = $this->konv_uang($post['jumlah']);

        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id           = $post['id'];
        $this->idsupplier   = $post['idsupplier'];
        $this->idjenis      = $post['idjenis'];
        $this->nama         = ucwords($post['nama']);
        $this->modal        = $this->konv_uang($post['modal']);
        $this->harga        = $this->konv_uang($post['harga']);
        $this->jumlah       = $this->konv_uang($post['jumlah']);
        $this->sisa         = $post['sisa'];

        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
	}

	private function konv_uang($angka)
    {
        $jadi = str_replace(".","",$angka);
        return $jadi;
    }

}
