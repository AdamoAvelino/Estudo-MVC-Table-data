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
    private $model_perfil;


    public function __construct() {
        parent::__construct();
        $this->tabela = 'usuarios';
        $this->model_perfil = new Perfil_Model();
    }
    
    public function listaUsuario(){
        $this->dataset['usuarios'] = $this->read();
        $this->getPerfil(false);
        return $this->dataset;
    }
    
    public function singleUsuario($col, $where){
        $this->dataset['usuarios'] = $this->readSingle($col, $where);
        $this->getPerfil(true);
        return $this->dataset;
    }
    
    private function getPerfil($single){
        $registros = ($single) ? $this->dataset : $this->dataset['usuarios'];

        foreach($registros as $usuario){
//            var_dump($usuario);
            $this->model_perfil->listaPerfil(null, ['id = '.$usuario['perfil']]);
            if($single){
                $dataset_usuarios = $this->model_perfil->relaciona($usuario);
            }else{
                $dataset_usuarios[] = $this->model_perfil->relaciona($usuario);
            }
        }
        unset($this->dataset['usuarios']);
        $this->dataset['usuarios'] = $dataset_usuarios;
        
//        var_dump($this->dataset);
    }
    
    
    public function relaciona($array){
//        var_dump($array);
        extract($this->dataset['usuarios']);
        $array['autor_nome'] = $nome;
        $array['perfil_nome'] = $perfil_nome;
        $array['editar_artigo'] = $editar_artigo;
        $array['incluir_artigo'] = $incluir_artigo;
        $array['editar_usuario'] = $editar_usuario;
        $array['incluir_usuario'] = $incluir_usuario;
        return $array;
        
    }
}
