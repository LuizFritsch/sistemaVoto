<?php
/**
 * Created by PhpStorm.
 * User: bakad
 * Date: 10/11/2018
 * Time: 10:28
 */

class PautaFactory extends CI_Model
{
        public function __construct(){
            $this->load->database();
            $this->load->model('pautaModel');
        }

        public function get_pautas($id){
            $pautas = array();

            $query = $this->db->query("SELECT pautas.id_pauta, pautas.titulo, pautas.descricao, pautas.is_ativa, relator.nome_relator FROM pautas
                                    INNER JOIN relator
                                    ON relator.id_relator = pautas.id_relator
                                    INNER JOIN reunioes
                                    ON reunioes.id_reuniao = pautas.id_reuniao
                                    WHERE pautas.id_reuniao = ".$id." AND pautas.is_ativa = 0
                                    ORDER BY pautas.id_pauta");
            $result = $query->result_array();


            foreach ($result as $r){
                $pautaDummy = new PautaModel();
                $pautaDummy->setId($r['id_pauta']);
                $pautaDummy->setTitulo($r['titulo']);
                $pautaDummy->setDescricao($r['descricao']);
                $pautaDummy->setNomeRelator($r['nome_relator']);
                $pautaDummy->setIs_ativa($r['is_ativa']);

                $pautas[] = $pautaDummy;
            }
            return $pautas;
        }

        public function get_pauta_ativa($id_reuniao){
            $pauta = new PautaModel();
            $opcoes = array();

            $this->db->select('*');
            $this->db->from('votos');
            $this->db->join('pautas', 'votos.id_pauta = pautas.id_pauta');
            $this->db->where('pautas.id_reuniao', $id_reuniao);
            $this->db->where('pautas.is_ativa', 1);

            $result = $this->db->get();
            $results = $result->result_object();

            $pauta->setTitulo($result->first_row()->titulo);
            $pauta->setDescricao($result->first_row()->descricao);
            $pauta->setId($result->first_row()->id_pauta);
            foreach ($results as $r)
                $opcoes[$r->id_voto] = $r->opcao;
            $pauta->setOpcoesDeVoto($opcoes);

            return $pauta;
        }

        public function get_resultados($id_pauta){
            $resultados = array();

            $this->db->select('*');
            $this->db->from('pautas');
            $this->db->join('votos', 'votos.id_pauta = pautas.id_pauta');
            $this->db->join('voto_membro', 'voto_membro.id_voto_fk = votos.id_voto');
            $this->db->join('membros', 'membros.id_membro = voto_membro.id_membro_fk');
            $this->db->where('votos.id_pauta', $id_pauta);

            $result = $this->db->get();
            $results = $result->result_object();

            foreach ($results as $r) {
               $resultados[] = array('nome'=>$r->nome,'opcao'=>$r->opcao);
            }

            return $resultados;
        }
}