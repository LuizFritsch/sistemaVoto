<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Servidor extends CI_Controller
{

    public function index()
    {
        $arquivo = 'Arquivo/arquivo.txt';

        $handle = fopen($arquivo, 'r');

        $ler = fread($handle, filesize($arquivo));

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');


        echo "data: {$ler}\n\n";
        flush();
        fclose($handle);
    }

    public function voto()
    {
        $arquivo = 'Arquivo/votos.txt';

        $handle = fopen($arquivo, 'r');

        $ler = fread($handle, filesize($arquivo));

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');


        echo "data: {$ler}\n\n";
        flush();
        fclose($handle);
    }

}