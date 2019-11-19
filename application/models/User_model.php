<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table     = "admin";

    public $id;
    public $idtoko;
    public $uname;
    public $pass;
    public $foto;
    public $status;

    public function rules()
    {
        return [
            ['field' => 'uname',
            'label' => 'Bidang',
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

    public function save()
    {
        $post = $this->input->post();
        $this->idtoko         = $post["idtoko"];
        $this->uname          = strtolower($post['uname']);
        $this->pass           = md5($post['pass']);
        $this->foto           = "text.png";
        $this->status         = "Co-Admin";
        
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id             = $post["id"];
        $this->idtoko         = $post["idtoko"];
        $this->uname          = strtolower($post['uname']);
        $this->pass           = $post['pass'];
        $this->foto           = "text.png";
        $this->status         = "Co-Admin";
        
        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
		return $this->db->delete($this->_table, array("id" => $id));
	}
}
