<?php
/**
 * classe para iniciar o system
 *
 * @author adamo
 */
final class System {

    private $url;
    private $explode;
    private $controller;
    private $action;
    private $param;
    private $logado;

    public function __construct(){

        $this->getUrl();
        $this->getExplode();
        $this->getcontroller();
        $this->getAction();
        $this->getPost();
        $this->getParam();

    }


    public function getUrl(){

        $this->url = isset($_GET['url']) ? $_GET['url'] : 'home/index_action';
//        echo $this->url;

    }

    function getExplode(){
        $this->explode = explode('/', $this->url);

    }

    function getcontroller(){
        $this->controller = ucfirst($this->explode[0]);


    }

    function getAction(){
        $acao = (!isset($this->explode[1]) or !$this->explode[1] or $this->explode[1] == 'index') ? 'index_action' : $this->explode[1];
        $this->action = $acao;
    }

    function getParam(){
        if(count($this->explode) > 2 and count($this->explode) % 2 == 0){
            unset($this->explode[0], $this->explode[1]);

            foreach($this->explode as $posicao => $valor){
                if(!$valor)
                    die('Eita!!! Falta Parametro...');

                if($posicao % 2 == 0)
                    $ch[] = $valor;

                if($posicao % 2 != 0)
                    $vl[] = $valor;

            }
            $this->param = array_combine($ch, $vl);
        }
    }

    public function getPost(){

        if(isset($_POST)){
            foreach($_POST as $coluna => $valor){

                 if($valor != '') {
                    $this->param[$coluna]  = $valor;
                }
            }

        }


    }

    public function run(){

        $controle = $this->controller.'_Controller';
        $acao = $this->action;
        $objeto = new $controle();
        $objeto->parans = $this->param;
        $objeto->$acao();
    }

}
