<?php
/**
*
*/
class Artigos_Model extends Model
{
    public $id;

    function __construct()
    {
        parent::__construct();
        $this->tabela = 'artigos';
    }

    public function salvar(Array $parametros){

        $this->insert($parametros);
    }

    public function listar($col, $where){

        return $this->read($col, $where);
    }

    public function getId($col, $order, $limit){
        $varset =  $this->read($col, null, $order, $limit);
        $this->id = $varset[0]['id'];
    }

    public function single($col, $where){
            return $this->readSingle($col, $where);
    }

    public function excluir($parametros){

        $this->delete($parametros);
        Transacao::executa();
    }

    public function atualiza($coluna, $condicao){
        $this->update($coluna, $condicao);

    }
}