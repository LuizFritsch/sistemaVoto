<?php
/**
 * Created by PhpStorm.
 * User: bakad
 * Date: 08/11/2018
 * Time: 20:13
 */

class ReuniaoFactory extends CI_Model
{

    public function __construct(){
        $this->load->database();
        $this->load->model('reuniaoModel');
    }

    public function get_reunioes(){
        $reunioes = array();

        $query = $this->db->query("SELECT reunioes.id_reuniao, reunioes.data_hora_inicio, reunioes.data_hora_fim,
reunioes.tipo, reunioes.comissao, reunioes.sala, reunioes.is_aberta, membros.nome FROM reunioes
INNER JOIN membros
ON reunioes.id_moderador = membros.id_membro
ORDER BY reunioes.data_hora_inicio");
        $result = $query->result_array();

        foreach ($result as $r){
            $reuniaoDummy = new ReuniaoModel();
            $reuniaoDummy->setId($r['id_reuniao']);
            $reuniaoDummy->setModerador($r['nome']);
            $reuniaoDummy->setAberta($r['is_aberta']);
            $reuniaoDummy->setInicio($r['data_hora_inicio']);
            $reuniaoDummy->setFim($r['data_hora_fim']);
            $reuniaoDummy->setTipo($r['tipo']);
            $reuniaoDummy->setComissao($r['comissao']);
            $reuniaoDummy->setSala($r['sala']);
            $reunioes[] = $reuniaoDummy;
        }

        return $reunioes;
    }
}