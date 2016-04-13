<?php

/**
 *  Descrição: Autenticacao_controller
 * Verifica se há autenticação para o ambiente admin.
 * Autentica logins
 * Cadastra novos usuarios.
 * @author adamo
 */
class Autenticacao_Controller extends Controller {

    private $auth;
    public $param;

/*
* Metodo Construtor inisia sessão e atrubui u valor booleano a propriedade privatda $auth
*/
    function __construct() {
        session_start();
        $this->auth = (isset($_SESSION['login']) and isset($_SESSION['senha'])) ? TRUE : FALSE;

    }

    /*
    * O metodo index faz duas verificação:
    * A primeira verificação é se existe uma solicitação de login
    * A segunda verificação é se existe uma autenticação.
    * Na primeira verificação, caso exista uma solicitação de login, o Model de autenticação será carregado e a verificação
    * -- do login será feita. Se for validaddo, o metodo de autenticação será solicitador e a autenticação será feita.
    * Na segunda verificação, se não houver uma autenticação, será redirecionado para a tela de login.
    */

    public function index_action() {


            if (isset($this->parans['email'])) {

                $aut = new Model_Autenticacao();
                $valida = $aut->autentica($this->parans['email'], $this->parans['senha']);
                if (isset($valida[0])) {
                    $this->parans['nome'] = $valida[0]['nome'];
                    $this->altentica();
                    $mensagen['alert-success'] = '';
                } else{
                    $mensagen['alert-danger'] = "Email ou senha Não Existe";

                    $this->template($mensagen);

                }

            }

            if (!$this->auth) {
                # header("Location: login");
                $mensagen['alert-info'] = "Faça o Login";
                $this->template($mensagen);

            }

    }

    /*
    * O metodo autentica, carrega as variaveis de sessão e valida a propriedade auth
    */

    private function altentica() {

        $_SESSION['login'] = $this->parans['email'];
        $_SESSION['senha'] = $this->parans['senha'];
        $_SESSION['nome'] = $this->parans['nome'];
        $this->auth = TRUE;
    }

    /*
    * O Metodo fechar, apaga as variaveis de sessão e redireciona para a tela de admin, sem a a utenticacao.
    */

    public function fechar() {
        unset($_SESSION['login'], $_SESSION['senha']);
        header("Location: /admin");
    }

    /*
    * O Metodo cadastro verifica se as solicitações de senha e confirmação de senha são igauais.
    * Caso as verificações sejam satisfeitas, o Model é instanciado e um novo registros é inserido e o metodo de autentica
    é executado e redirecionado para a tela de login.
    * Caso as solicitações não sejam iguais uma mesagem de alerta é disparada e o metodo template é executado.
    *
    */
    public function cadastro() {

        if ($this->parans['senha'] == $this->parans['confirmaSenha']) {

            $cad = new Model_Autenticacao();
            $cad->cadastrar(['email' => $this->parans['email'], 'senha' => $this->parans['senha'], 'nome' => $this->parans['nome']]);
            $this->altentica();
            header("Location: /admin");
        }else{
            $mensagen['alert-danger'] = 'As senhas devem ser iguais';
            $this->template($mensagen);
        }


    }

/*
* Esse metodo é executado toda vez que existe uma solicitação para uma ambiente admin.
* Verifica de há uma autenticação.
* Se não hover autenticação, os parametros são carregados e index_action executado.
* Após a excução do metodo index, é feita uma nova verificação da propriedade $auth.
* Caso seja negada o prgram é interronpido, para que nenhuma outra view carregue em cima de outra.
*/
     public function autentica_ok($parametros){
        if(! $this->auth){
            $this->parans = $parametros;
            $this->index_action();
            if(!$this->auth){
                exit();
            }
        }
    }

    /*
    * Carrega a View que será necessária ser carregada.
    * Se autenticado, a view admin.phtml, será carregada.
    * Se não a tela de login será carregada.
    */
     public function template($mensagem) {

        $template = (implode(' ', array_keys($mensagem)) == 'alert-success') ? 'admin' : 'login';
        $msg['mensagem'] = ($template == 'login') ? $mensagem : null;
        $menuheader = ($template == 'admin') ? true : null;
        $this->view($template, $msg, $menuheader);
        exit();
    }

}
