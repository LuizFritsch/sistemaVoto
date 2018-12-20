<?php

class ReuniaoModel extends CI_Model {
	private $aberta;
	private $moderador;
	private $inicio;
	private $fim;
    private $tipo;
    private $comissao;
    private $sala;
    private $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function isAberta(){
        if ($this->aberta == "1"){
            return true;
        }

        $now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
     /*   var_dump($this->inicio < $now);
        var_dump($this->fim > $now);*/
        return $this->inicio < $now and $this->fim > $now;
    }

    public function getInicioFormatado(){
        return $this->inicio->format('d/m/Y H:i');
    }

    public function getFimFormatado(){
        return $this->fim->format('d/m/Y H:i');
    }
    /**
     * @return mixed
     */
    public function getAberta()
    {
        return $this->aberta;
    }

    public function get_reunioes_moderador($id_moderador){

        $this->db->select('*');
        $this->db->from('reunioes');
        $this->db->where('id_moderador = ', $id_moderador);
        return $this->db->get()->result_array();

    }

    public function get_reunioes_abertas(){

        $this->db->select('*');
        $this->db->from('reunioes');
        $this->db->where('is_aberta = 1');
        return $this->db->get()->result_array();

    }

    public function update_sit_reuniao($id){
        $query = $this->db->query("UPDATE reunioes SET reunioes.is_aberta = 1 WHERE reunioes.id_reuniao = ".$id);
        return $query;
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
     * @param mixed $aberta
     */
    public function setAberta($aberta)
    {
        $this->aberta = $aberta;
    }

    /**
     * @return mixed
     */
    public function getModerador()
    {
        return $this->moderador;
    }

    /**
     * @param mixed $moderador
     */
    public function setModerador($moderador)
    {
        $this->moderador = $moderador;
    }

    /**
     * @return mixed
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * @param mixed $inicio
     */
    public function setInicio($inicio)
    {
        $this->inicio = new DateTime($inicio);
    }

    /**
     * @return mixed
     */
    public function getFim()
    {
        return $this->fim;
    }

    /**
     * @param mixed $fim
     */
    public function setFim($fim)
    {
        $this->fim = new DateTime($fim);
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getComissao()
    {
        return $this->comissao;
    }

    /**
     * @param mixed $comissao
     */
    public function setComissao($comissao)
    {
        $this->comissao = $comissao;
    }

    /**
     * @return mixed
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * @param mixed $sala
     */
    public function setSala($sala)
    {
        $this->sala = $sala;
    }


}
