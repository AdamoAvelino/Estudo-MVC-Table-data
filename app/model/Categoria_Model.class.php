<?php
/**
*
*/
class Categoria_Model extends Model
{

    public $id;
    public $dataset;

    function __construct()
    {
        parent::__construct();
        $this->tabela = 'categoria';
    }

    public function nova($colunas){
        $this->insert($colunas);

    }

    public function listaCategorias(){
        $this->dataset = $this->read(['id','nome']);
        return $this->montaXml();
    }
//

    public function montaXml(){
        $xml = new MontaXml();
       return $xml->montarDocumento($this->dataset, $this->tabela);

    }



}