<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: bakad
 * Date: 22/11/2018
 * Time: 20:45
 */

class ReunioesMembro extends CI_Controller{

    public function get_reunioes_membro($id_membro){
        $this->load->model('membroFactory');
        $membroFac = new MembroFactory();
        return $reunioes_do_membro = $membroFac->get_reunioes_membro($id_membro);
    }

    public function index(){
        $data['titulo'] = 'Reunião';
        $data['msg_erro'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('reunioes/membro/index');
        $this->load->view('templates/footer');
    }

    public function abrir_reuniao($id_membro){
        $this->load->model('membroFactory');
        $data['titulo'] = 'Reunião';
        $data['msg_erro'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('reunioes/membro/participacao');
        $this->load->view('templates/footer');
        $membroFac = new MembroFactory();
        $membro = $membroFac->get_membro($id_membro);
        $membro->registrarse($_POST['id_reuniao']);
    }

    public function submeter_voto(){
        $this->load->model('membroFactory');
        $membroFac = new MembroFactory();
        $data['titulo'] = 'Reunião';
        $data['msg_erro'] = '';
        $id_voto_escolhido = $_POST['id_voto'];


        $this->load->view('templates/header', $data);
        $this->load->view('reunioes/membro/resultado_votacao');
        $this->load->view('templates/footer');

        $membro = $membroFac->get_membro(3);//Finge que esse id ta saindo da sessão xD
        $membro->votar($id_voto_escolhido);
    }

    public function inicia_votacao(){
        $this->volta_id();
        $id_item = $_POST['id_item'];
        $this->load->model('pautaModel');
        $itemPauta = $this->pautaModel->buscarPautaPorId($id_item);
        $opcoes = $this->pautaModel->buscarOpcoesVotos($id_item);
        $dados = array('item' => $itemPauta, 'opcoes' => $opcoes);
        $this->load->view('templates/header');
        $this->load->view('reunioes/membro/votacao', $dados);
        $this->load->view('templates/footer');

    }

    public function volta_id(){
        $arquivo = 'Arquivo/arquivo.txt';

        $html = 'false';

        $handle = fopen($arquivo, 'w+');

        $ler = fwrite($handle, $html);

        fclose($handle);
    }
    public function busca_id_membro($nome_membro){

        return $this->model->membroModal->get_id_membro($nome_membro);
    }
}