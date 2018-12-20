<?php
/**
 * Created by PhpStorm.
 * User: bakad
 * Date: 20/10/2018
 * Time: 10:19
 */

class ParticipacaoModel {

    private $membro;
    private $reuniao;

    function participacao($membro, $reuniao){
        $this->membro = $membro;
        $this->reuniao = $reuniao;
    }
}