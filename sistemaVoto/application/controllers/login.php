<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: renar
 * Date: 11/12/2018
 * Time: 15:00
 */

class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginModel');
    }

    public function index(){
        $this->load->view('templates/header');
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }

    public function logar(){
        $nome = $this->input->post('nome_membro');
        $membro = $this->loginModel->get_login_membros($nome);
        if (empty($membro)){
            $this->load->view('templates/header');
            $this->load->view('pages/login');
            $this->load->view('templates/footer');
        }else{
            $this->session->set_userdata('sessao', $nome);

            $this->load->view('templates/header');
            $this->load->view('pages/inicio');
            $this->load->view('templates/footer');
        }

    }

    public function logout(){
        $this->session->unset_userdata('sessao');
        $this->load->view('templates/header');
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }

    public function redirecionar_inicio() {
        $this->load->view('templates/header');
        $this->load->view('pages/inicio');
        $this->load->view('templates/footer');
    }


}