<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenis extends CI_Model
{
    private $_table  = "jenis";

    public $idjenis;
    public $namajns;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama Jenis',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["idjenis" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->namajns = ucfirst($post['nama']);

        $this->db->insert($this->_table, $this);
    }    

    public function update()
    {
        $post = $this->input->post();

        $this->idjenis = $post['idjenis'];
        $this->namajns = ucfirst($post['nama']);

        $this->db->update($this->_table, $this, array('idjenis' => $post['idjenis']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("idjenis" => $id));
	}
}
