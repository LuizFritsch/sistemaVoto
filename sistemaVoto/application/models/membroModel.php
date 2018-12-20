<?php

/**
 * TODO Auto-generated comment.
 */
class MembroModel extends CI_Model
{
    /**
     *
     */
    private $nome;
    private $id_membro;


    /**
     * TODO Auto-generated comment.
     */
    public function registrarse($id_reuniao, $id_membro2)
    {
        $this->db->set('compareceu', 1);
        $this->db->where('id_membro_convidado', $id_membro2);
        $this->db->where('id_reuniao', $id_reuniao);
        $this->db->update('convites');
    }


    /**
     * TODO Auto-generated comment.
     */
    public function votar($id_voto)
    {
        $data = array(
            'id_voto_fk' => $id_voto,
            'id_membro_fk' => $this->id_membro
        );
        $this->db->insert('voto_membro', $data);
    }

    /**
     * TODO Auto-generated comment.
     */
    public function visualizarResultado($votacao)
    {
    }

    public function get_membro_nome($nome)
    {

        $this->db->select('*');
        $this->db->from('membros');
        $this->db->where('nome = ', $nome);
        return $this->db->get()->result_array();

    }

    public function get_id_membro($nome)
    {

        $this->db->select('*');
        $this->db->from('membros');
        $this->db->where('nome = ', $nome);
        return $this->db->get()->result_array();

    }

    public function votantes_por_id_item($id_item)
    {
        $this->db->from('voto_membro');
        $this->db->join('membros', 'membros.id_membro = voto_membro.id_membro_fk');
        $this->db->join('votos', 'votos.id_voto = voto_membro.id_voto_fk');
        $this->db->where('votos.id_pauta = ', $id_item);
        $this->db->select('*');
        return $this->db->get()->result_array();

    }

    public function buscar_todos_membros()
    {
        $this->db->from('membros');
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    public function mandar_voto($id_opcao, $id_membro)
    {
        $data = array(
            'id_voto_fk' => $id_opcao,
            'id_membro_fk' => $id_membro
        );
        $this->db->insert('voto_membro', $data);
    }


    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getIdMembro()
    {
        return $this->id_membro;
    }

    /**
     * @param mixed $id_membro
     */
    public function setIdMembro($id_membro)
    {
        $this->id_membro = $id_membro;
    }


}
