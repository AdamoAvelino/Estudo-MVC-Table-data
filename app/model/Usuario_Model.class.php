<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_Model
 *
 * @author adamo
 */
class Usuario_Model extends Model{
    public $dataset;


    public function __construct() {
        parent::__construct();
        $this->tabela = 'usuarios';
    }
    
    
    public function singleUsuario($col, $where){
        $this->dataset = $this->readSingle($col, $where);
        return $this->dataset;
    }
    

    
    
    public function relaciona($array){
//        var_dump($array);
        extract($this->dataset);
        $array['autor_nome'] = $nome;
        return $array;
        
    }
}
