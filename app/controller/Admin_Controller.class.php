<?php

/**
 * Description of Admin_Controler
 *
 * @author adamo
 */
class Admin_Controller extends Controller{

    private $autenticacao;

    function __construct(){

        $this->autenticacao = new Autenticacao_Controller();

    }

    public function index_action(){
            $this->autenticacao->autentica_ok($this->parans);
            $this->view('admin');

    }

    public function login(){
        $this->view('login');

    }




}
