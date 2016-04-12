<?php

/**
*
*/
class Media_Controller extends Controller
{

    private $model;

    function __construct()
    {
            $this->model = new Media_Model();
    }

    public function nova(){
        $this->model->incluir();
        Transacao::executa();
        $this->listar();
    }

    public function listar(){
          $data = $this->model->mediaList();
          $this->montaXml($data, 'media');
    }

    private function montaXml($propriedades, $tabela){
        header('content-type: text/xml');
        $xmlObjeto = new MontaXml();
        $xml =  $xmlObjeto->montarDocumento($propriedades, $tabela, 'media');
        echo $xml;
    }
}