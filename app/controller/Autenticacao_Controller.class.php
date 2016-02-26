<?php

/**
 * Description of Autenticacao_controller
 *
 * @author adamo
 */
class Autenticacao_Controller extends Controller {

    public $auth;
    public $param;

    function __construct() {
        session_start();

        $this->auth = (isset($_SESSION['login']) and isset($_SESSION['senha'])) ? TRUE : FALSE;
    }

    public function template($mensagem) {
//        echo implode(' ', array_keys($mensagem));
        $template = (implode(' ', array_keys($mensagem)) == 'alert-success') ? 'admin' : 'login';
        $msg['mensagem'] = ($template == 'login') ? $mensagem : null;
        $this->view($template, $msg);
    }

    public function index_action() {

        if (!$this->auth or isset($this->param['email'])) {

            if (isset($this->param['email'])) {

                $aut = new Model_Autenticacao();
                $valida = $aut->autentica($this->param['email'], $this->param['senha']);
                if (isset($valida[0])) {
                    $this->altentica();
                    $mensagen['alert-success'] = '';
                } else
                    $mensagen['alert-danger'] = "Email ou senha Não Existe";

            }elseif (!$this->auth) {

                #header("Location: admin/login");
                $mensagen['alert-info'] = 'Faça o login';
            }

        } else {
            $mensagen['alert-success'] = '';
        }

        $this->template($mensagen);
    }

    private function altentica() {

        $_SESSION['login'] = $this->param['email'];
        $_SESSION['senha'] = $this->param['senha'];
    }

    public function fecha() {
        unset($_SESSION['login'], $_SESSION['senha']);
    }

    public function cadastro() {
//        var_dump($this->param);
        if ($this->param['senha'] == $this->param['confirmaSenha']) {
            $cad = new Model_Autenticacao();
            $cad->cadastrar(['email' => $this->param['email'], 'senha' => $this->param['senha']]);
            header("Location: /admin");
        }else{
            $mensagen['alert-danger'] = 'As senhas devem ser iguais';
            $this->template($mensagen);
        }


    }

}
