<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model
{
    private $_table  = "supplier";

    public $idsupplier;
    public $namasp;
    public $alamat;
    public $telp;
    public $email;
    public $nowa;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama Supplier',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idsupplier" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->namasp   = strtoupper($post['nama']);
        $this->alamat   = $post['alamat'];
        $this->telp     = $post['telp'];
        $this->email    = $post['email'];
        $this->nowa     = $post['nowa'];

        $this->db->insert($this->_table, $this);
    }    

    public function update()
    {
        $post = $this->input->post();

        $this->idsupplier = $post['idsupplier'];
        $this->namasp     = strtoupper($post['nama']);
        $this->alamat     = $post['alamat'];
        $this->telp       = $post['telp'];
        $this->email      = $post['email'];
        $this->nowa       = $post['nowa'];

        $this->db->update($this->_table, $this, array('idsupplier' => $post['idsupplier']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idsupplier" => $id));
	}
}
