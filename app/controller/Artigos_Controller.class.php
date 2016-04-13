<?php
/**
*
*/
class Artigos_Controller extends Controller
{
    private $dataset;
    private $model;
    private $autenticacao;

    function __construct(){
        $this->autenticacao = new Autenticacao_Controller();
        $this->model = new Artigos_Model;
    }

    public function index_action(){
        $this->autenticacao->autentica_ok($this->parans);
        $this->listar();
        $this->view('artigos', $this->dataset, true);

    }

    public function form($campos){
        $this->view('artigos_form', $campos, true);
    }

//Salvar Registros
    public function salvar(){
        if(isset($this->parans['id'])){
            $this->model->id = $this->parans['id'];
            $this->model->atualiza($this->parans, ['id = '.$this->model->id]);
             Transacao::executa();
        }else{
            $this->model->salvar($this->parans);
            Transacao::executa();

        }

            $this->artigo(null, ['id = '. $this->model->id]);
            $this->incluir(TRUE);

    }

// incluir Formulario Para alteração ou inclusão
    public function incluir($atualiza = NULL){

        if(!$atualiza){
            $campos['artigos'] = array();
            $campos['categorias'] = $this->model->model_categoria->listaCategorias(TRUE);
        }else{
            $campos =  $this->dataset;
        }
        /*var_dump($campos);*/
        $this->form($campos);
    }

//Listar Diversos registros
    public function listar($col = null, $where = null){
        $this->dataset = $this->model->listar($col, $where);
    }


//Buscar Registros unicos ou agrupados
    public function  artigo($col, $where) {
        /*var_dump($this->dataset); die();*/
        $this->dataset = $this->model->single($col, $where);
    }

   public function delete(){

        $this->model->excluir(["id = {$this->parans['id']}"]);
        $this->index_action();
   }

   public function edit(){
        $this->autenticacao->autentica_ok($this->parans);
        $this->artigo(['*'], ['id = '.$this->parans['id']]);
        $this->incluir(TRUE);
   }
}