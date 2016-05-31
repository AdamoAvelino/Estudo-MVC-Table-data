<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perfil_Model
 *
 * @author adamo
 */
class Perfil_Model extends Model{
    
    private $dataset;
    
    
    public function __construct() {
        parent::__construct();
        $this->tabela = 'perfil_usuario';
        
    }
    
    public function listaPerfil($col, $where){
        $this->dataset = $this->readSingle($col, $where);
//        var_dump($this->dataset);
        return $this->dataset;
    }
    
    public function relaciona($array){
//        var_dump($this->dataset);
        extract($this->dataset);
        $array['perfil_nome'] = $perfil;
        $array['editar_artigo'] = $editar_artigo;
        $array['incluir_artigo'] = $incluir_artigo;
        $array['incluir_usuario'] = $incluir_usuario;
        $array['editar_usuario'] = $editar_usuario;
        return $array;
    }
}
