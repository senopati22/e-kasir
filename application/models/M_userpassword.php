<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_userpassword extends CI_Model
{
    private $_table = "user";

    public $user_id;
    public $user_password;

    public function rules()
    {
        return [
            ['field' => 'passwordlama',
            'label' => 'Password Lama',
            'rules' => 'required'],
            
            ['field' => 'user_password',
            'label' => 'Password Baru',
            'rules' => 'required'],
            
            ['field' => 'confirm_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|matches[user_password]']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->user_id        = $post["user_id"];
        $this->user_password  = md5($post['user_password']);
        
        $this->db->update($this->_table, $this, array('user_id' => $post['user_id']));
    }
}