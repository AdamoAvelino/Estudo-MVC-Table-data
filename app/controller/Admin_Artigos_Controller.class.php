<?php
/**
*
*/
class Admin_Artigos_Controller extends Controller
{
    private $dataset;
    private $model;

    function __construct(){
        $this->model = new Admin_Artigos_Model;
    }

    public function index_action(){
        $this->listar();
        $this->view('admin_artigos', $this->dataset);

    }

    public function form($campos = NULL){
        $this->view('admin_artigos_form', $campos);
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
            $this->getLast();
        }
            $this->artigo(null, ['id = '.$this->model->id]);
            $this->incluir();

    }

// incluir Formulario Para alteração ou inclusão
    public function incluir(){
        $campos = ($this->dataset) ? $this->dataset : NULL;
        $this->form($campos);
    }

//Listar Diversos registros
    public function listar($col = null, $where = null){

        $this->dataset['artigos'] = $this->model->listar($col, $where);

    }

//Buscar id do Ultimo Registro
    private function getLast(){
        $this->model->getId(['id'], 'id DESC', '1');
    }

//Buscar Registros unicos ou agrupados
    public function  artigo($col, $where) {
        $this->dataset = $this->model->single($col, $where);
    }

   public function delete(){

        $this->model->excluir(["id = {$this->parans['id']}"]);
        $this->index_action();
   }

   public function edit(){
        $this->artigo(['*'], ['id = '.$this->parans['id']]);
        $this->incluir();

   }
}