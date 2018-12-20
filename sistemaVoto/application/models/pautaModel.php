<?php

class PautaModel extends CI_Model implements JsonSerializable {

    private $id;
    private $titulo;
    private $descricao;
    private $nomeRelator;
    private $is_ativa;
    private $opcoes_de_voto;


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    /**
     * @return mixed
     */
    public function getOpcoesDeVoto()
    {
        return $this->opcoes_de_voto;
    }

    /**
     * @param mixed $opcoes_de_voto
     */
    public function setOpcoesDeVoto($opcoes_de_voto)
    {
        $this->opcoes_de_voto = $opcoes_de_voto;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getNomeRelator()
    {
        return $this->nomeRelator;
    }

    /**
     * @param mixed $nomeRelator
     */
    public function setNomeRelator($nomeRelator)
    {
        $this->nomeRelator = $nomeRelator;
    }

    /**
     * @param mixed $is_ativa
     */
    public function setIs_ativa($is_ativa)
    {
        $this->is_ativa = $is_ativa;
    }

    /**
     * @return mixed
     */
    public function getIsAtiva()
    {
        return $this->is_ativa;
    }




    public function gerarResultados() {
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'nomeRelator' => $this->nomeRelator
        ];
    }

    public function gravarOpcaoVotos($json){

        $this->db->query("UPDATE pautas SET `is_ativa` = 1 WHERE id_pauta = ".$json[0]->idPauta);

        foreach ($json as $voto) {
            $this->db->query("INSERT INTO `votos`(`id_pauta`, `opcao`) VALUES (".$voto->idPauta.", \"".$voto->opVoto."\")");
        }

        return null;
    }

    public function buscarPautaPorId($id_item){
        $this->db->from('pautas');
        $this->db->where('pautas.id_pauta', $id_item);
        $this->db->select('*');
        return $this->db->get()->result_array();

    }

    public function buscar_votos($id_pauta){
        $this->db->from('voto_membro');
        $this->db->join('votos', 'votos.id_voto = voto_membro.id_voto_fk');
        $this->db->where('votos.id_pauta', $id_pauta);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }
    public function buscar_opcoes($id_pauta){
        $this->db->from('votos');
        $this->db->where('id_pauta =', $id_pauta);
        $this->db->select('*');
        return $this->db->get()->result_array();
    }

    public function buscarOpcoesVotos($id_item){
        $this->db->from('votos');
        $this->db->where('votos.id_pauta', $id_item);
        $this->db->select('*');
        return $this->db->get()->result_array();

    }
    public function get_id_opcao($id_item, $opcao){
        $this->db->from('votos');
        $this->db->where('votos.id_pauta', $id_item);
        $this->db->where('votos.opcao', $opcao);
        $this->db->select('*');
        return $this->db->get()->result_array();

    }
}
