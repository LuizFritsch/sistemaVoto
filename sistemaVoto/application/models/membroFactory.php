<?php
/**
 * Created by PhpStorm.
 * User: bakad
 * Date: 22/11/2018
 * Time: 21:28
 */

class MembroFactory extends CI_Model{

    public function __construct(){
        $this->load->model('membroModel');
        $this->load->model('reuniaoModel');
    }

    public function get_reunioes_membro($id_membro){
        $reunioes = array();

        $this->db->select('*');
        $this->db->from('convites');
        $this->db->join('reunioes', 'convites.id_reuniao = reunioes.id_reuniao');
        $this->db->join('membros', 'membros.id_membro = reunioes.id_moderador');
        $this->db->where('id_membro_convidado',$id_membro);
        $result = $this->db->get();

        foreach ($result->result() as $r){
            //var_dump($r);
            $reuniaoDummy = new ReuniaoModel();
            $reuniaoDummy->setId($r->id_reuniao);
            $reuniaoDummy->setModerador($r->nome);
            $reuniaoDummy->setAberta($r->is_aberta);
            $reuniaoDummy->setInicio($r->data_hora_inicio);
            $reuniaoDummy->setFim($r->data_hora_fim);
            $reuniaoDummy->setTipo($r->tipo);
            $reuniaoDummy->setComissao($r->comissao);
            $reuniaoDummy->setSala($r->sala);
            $reunioes[] = $reuniaoDummy;

        }

        return $reunioes;

    }

    public function get_membro($id_membro){
        $membro = new MembroModel();

        $this->db->select('*');
        $this->db->from('membros');
        $this->db->where('id_membro',$id_membro);
        $result = $this->db->get();

        $result = $result->first_row('array');
        $membro->setNome($result['nome']);
        $membro->setIdMembro($result['id_membro']);
        return $membro;
    }
}