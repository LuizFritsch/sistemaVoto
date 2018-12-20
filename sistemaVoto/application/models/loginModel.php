<?php
/**
 * Created by PhpStorm.
 * User: renar
 * Date: 11/12/2018
 * Time: 15:14
 */

class loginModel extends CI_Model
{

    public function get_login_membros($nome){

        $this->db->select('*');
        $this->db->from('membros');
        $this->db->where('nome = ', $nome);
        return $this->db->get()->result_array();

    }
}