<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reuniao extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('reuniaoModel');
        $this->load->model('reuniaoFactory');
        $this->load->model('membroModel');
    }

    public function index($msg='')
    {
        $data['reunioes'] = $this->reuniaoFactory->get_reunioes();
        $data['titulo'] = 'Reunião';
        $data['msg_erro'] = $msg;
        $this->load->view('templates/header', $data);
        $this->load->view('reunioes/index', $data);
        $this->load->view('templates/footer');
    }

    public function update_reuniaoModel($id){
        $this->reuniaoModel->update_sit_reuniao($id);
    }

    public function view()
    {	
        $nomeMembro = $this->session->userdata('sessao');
        $membro = $this->membroModel->get_membro_nome($nomeMembro);
        $idMembro = $membro[0]['id_membro'];
        $idReuniao = $_POST['id_reuniao'];
        $reunioesModerador = $this->reuniaoModel->get_reunioes_moderador($idMembro);
        $reuniaoAberta = $_POST['is_openable'];

        if(empty($reunioesModerador)){

            $this->membroModel->registrarse($idReuniao, $idMembro);

            $this->load->view('templates/header');
            $this->load->view('reunioes/membro/resultado_votacao');
            $this->load->view('templates/footer');
        }else{

            if ($reuniaoAberta == 0) {
                $idReuniao = $_POST['id_reuniao'];
                $dados = array('idReuniao' => $idReuniao);
                $this->reuniaoModel->update_sit_reuniao($idReuniao);
                $this->load->view('templates/header');
                $this->load->view('reunioes/reuniao_pauta', $dados);
                $this->load->view('templates/footer');
            } else {
                $idReuniao = $_POST['id_reuniao'];
                $dados = array('idReuniao' => $idReuniao);
                $this->load->view('templates/header');
                $this->load->view('reunioes/reuniao_pauta', $dados);
                $this->load->view('templates/footer');
            }
            

            /*$hora_inicio = $_POST['data_hora_fim'];
            $hora_fim = $_POST['data_hora_inicio'];
            $now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $openable = $_POST['is_openable'];
            
            //var_dump($is_open);
            //$openable = $is_open == 1 or ($hora_inicio < $now ? $hora_fim > $now : false);
            if($openable==1){
                $this->load->view('templates/header');
                $this->load->view('reunioes/reuniao_pauta', $dados);
                $this->load->view('templates/footer');
            } else {
                $this->index('Não!');
            }*/
        }




		

    }

    public function mostrarReunioes(){

        $nomeMembro = $this->session->userdata('sessao');
        $membro = $this->membroModel->get_membro_nome($nomeMembro);
        $idMembro = $membro[0]['id_membro'];

        $reunioesModerador = $this->reuniaoModel->get_reunioes_moderador($idMembro);
        if (empty($reunioesModerador)){

            $data['reunioes'] = $this->reuniaoModel->get_reunioes_abertas();
            $data['titulo'] = 'Reunião';
            $data['msg_erro'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('reunioes/index', $data);
            $this->load->view('templates/footer');
        }
        else{
            $data['reunioes'] = $reunioesModerador;
            $data['titulo'] = 'Reunião';
            $data['msg_erro'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('reunioes/index', $data);
            $this->load->view('templates/footer');
        }

    }

}