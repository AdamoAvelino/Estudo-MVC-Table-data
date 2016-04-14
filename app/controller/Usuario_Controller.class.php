<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_Controller
 *
 * @author adamo
 */
class Usuario_Controller extends Controller{
    private $model;
    private $dados;
    
    public function __construct() {
        $this->model = new Usuario_Model();
    }
    
    public function Index_Action(){
        
    }
    
    public function getUsuario(){
        $this->dados = $model->singleUsuario(null, ['id = '.$_SESSION['id_usuario']]);
    }
    
}
