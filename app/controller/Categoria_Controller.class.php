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
         $data= $this->model->listaCategorias();
          $xml = $this->montaXml($data[0], $data[1]);
        header('content-type: text/xml');
         echo $xml;
    }

    private function montaXml($propriedeades, $tabela){
      $xmlObjeto = new MontaXml();
       return $xmlObjeto->montarDocumento($propriedeades, $tabela, 'option');
    }
}