<?php
/**
*
*/
class Categoria_Controller extends Controller
{
    private $model;
    function __construct()
    {
        $this->model = new Categoria_Model();

    }

    function nova(){
        $this->model->nova($this->parans);
        Transacao::executa();
         $xml = $this->model->listaCategorias();
        header('content-type: text/xml');
         echo $xml;
    }
}