<?php
/**
*
*/
class Categoria_Model extends Model
{

    public $id;
    private $dataset;
    public $categoria_nome;

    function __construct()
    {
        parent::__construct();
        $this->tabela = 'categoria';
    }

    public function nova($colunas){
        $this->insert($colunas);
    }

    public function listaCategorias($server = NULL){
        $this->dataset['categoria'] = $this->read(['id','nome']);
            if($server){
                return $this->dataset['categoria'];
            }else{
               return [$this->dataset['categoria'], $this->tabela];
            }

    }

    public function singleCategoria($id){
            $result = $this->readSingle(null, ['id = '.$id]);
            extract($result);
            $this->categoria_nome = $nome;
    }
//




}