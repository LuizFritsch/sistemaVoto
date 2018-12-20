<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pautas extends CI_Controller
{
    var $id_pauta;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pautaFactory');
        $this->load->model('membroModel');
        $this->load->model('pautaModel');
    }

    public function get_Pautas($id)
    {
        /*print_r($this->pautaModel->get_pautas($id));*/
        return $this->pautaFactory->get_pautas($id);
    }

    public function gravarOpcaoVotos()
    {
        $json = json_decode($_POST['votos']);
        $this->id_pauta = $json[0]->idPauta;
        $this->muda_id($this->id_pauta);
        unset($_POST['votos']);
        $this->pautaModel->gravarOpcaoVotos($json);
    }

    public function muda_id($id_item)
    {
        $arquivo = 'Arquivo/arquivo.txt';
        $html = $id_item;
        $handle = fopen($arquivo, 'w+');
        $ler = fwrite($handle, $html);
        fclose($handle);

        $arquivo = 'Arquivo/id_pauta.txt';
        $html = $id_item;
        $handle = fopen($arquivo, 'w+');
        $ler = fwrite($handle, $html);
        fclose($handle);
    }

    public function volta_id($id_item)
    {
        $arquivo = 'Arquivo/id_pauta.txt';
        $html = $id_item;
        $handle = fopen($arquivo, 'w+');
        $ler = fwrite($handle, $html);
        fclose($handle);
    }

    public function esperaVotacaoModerador()
    {
        $id_item_pauta = $this->ler_id();
        $pauta = $this->pautaModel->buscarPautaPorId($id_item_pauta);
        $votos = $this->membroModel->votantes_por_id_item($id_item_pauta);

        $dados = array('pauta' => $pauta, 'votos' => $votos);
        $this->volta_id($id_item_pauta);
        $this->load->view('templates/header');
        $this->load->view('moderador_esperando', $dados);
        $this->load->view('templates/footer');
    }

    public function exibir_resultado()
    {
        $id_pauta = $_POST['id_pauta'];
        $listaVotos = $this->pautaModel->buscar_votos($id_pauta);
        $listaMembros = $this->membroModel->buscar_todos_membros();
        $listaOpcoes = $this->pautaModel->buscar_opcoes($id_pauta);
        $listaVotosNomes = null;
        $listaVotosPorcentagem = null;
        $listaOficial = null;
        $cont = 0;
        foreach ($listaVotos as $voto) {
            foreach ($listaMembros as $membro) {
                if ($voto['id_membro_fk'] === $membro['id_membro']) {
                    $listaVotosNomes[$cont]['nome'] = $membro['nome'];
                }
            }

            foreach ($listaOpcoes as $opcao) {
                if ($voto['id_voto_fk'] === $opcao['id_voto']) {
                    $listaVotosNomes[$cont]['opcao'] = $opcao['opcao'];
                }
            }
            $cont++;
        }
        $cont2 = 0;
        $nVotos = 0;
        foreach ($listaOpcoes as $opcao) {
            $listaVotosPorcentagem[$cont2]['opcao'] = $opcao['opcao'];
            $listaVotosPorcentagem[$cont2]['porcentagem'] = 0;
            foreach ($listaVotos as $voto) {
                if ($opcao['id_voto'] === $voto['id_voto_fk']) {
                    $nVotos++;
                    $listaVotosPorcentagem[$cont2]['opcao'] = $opcao['opcao'];
                    $listaVotosPorcentagem[$cont2]['porcentagem'] = $listaVotosPorcentagem[$cont2]['porcentagem'] + 1;
                }
            }
            $cont2++;
        }
        $cont3 = 0;
        foreach ($listaVotosPorcentagem as $opcaoPorcentagem) {
            $listaOficial[$cont3]['opcao'] = $opcaoPorcentagem['opcao'];
            $listaOficial[$cont3]['porcentagem'] = round(($opcaoPorcentagem['porcentagem'] / $nVotos) * 100, 2);
            $cont3++;
        }
        $vencedor = max(array_column($listaOficial, 'porcentagem'));
        foreach ($listaOficial as $valor) {
            if ($valor['porcentagem'] === $vencedor) {
                $vencedor = $valor['opcao'];
            }
        }

        $dados = array('listaVoto' => $listaVotosNomes, 'listaOpcoes' => $listaOficial, 'opcaoVencedora' => $vencedor);
        $this->load->view('templates/header');
        $this->load->view('reunioes/resultados', $dados);
        $this->load->view('templates/footer');

    }






    public function ler_id(){
        $arquivo = 'Arquivo/id_pauta.txt';

        $handle = fopen($arquivo, 'r');

        $ler = fread($handle, filesize($arquivo));

        flush();
        fclose($handle);
        return $ler;
    }
    public function mostrarResultado() {
        $this->load->view('templates/header');
        $this->load->view('reunioes/aguardando_resultado_votacao');
        $this->load->view('templates/footer');
    }

    public function votar(){
        $opcao = $_POST['opcaoVotada'];
        $id_item = $_POST['id_item'];
        $session_nome = $this->session->userdata('sessao');
        $id_membro = $this->membroModel->get_id_membro($session_nome);
        $id_opcao = $this->pautaModel->get_id_opcao($id_item, $opcao);
        $this->membro_votou_notificacao();
        $this->membroModel->mandar_voto($id_opcao[0]['id_voto'], $id_membro[0]['id_membro']);
        $this->load->view('templates/header');
        $this->load->view('reunioes/membro/resultado_votacao');
        $this->load->view('templates/footer');
    }

    public function membro_votou_notificacao(){
        $arquivo = 'Arquivo/votos.txt';

        $html = 'true';

        $handle = fopen($arquivo, 'w+');

        $ler = fwrite($handle, $html);

        fclose($handle);
    }

    public function get_pauta_ativa($id_reuniao){
        return $this->pautaFactory->get_pauta_ativa($id_reuniao);
    }
}