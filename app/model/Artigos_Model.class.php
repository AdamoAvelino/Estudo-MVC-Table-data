<?php

/**
 *
 */
class Artigos_Model extends Model {

    public $id;
    public $model_categoria;
    private $model_usuario;
    public $model_media;
    private $dataset;

    public function __construct() {
        parent::__construct();
        $this->tabela = 'artigos';
        $this->model_categoria = new Categoria_Model();
        $this->model_media = new Media_Model();
        $this->model_usuario = new Usuario_Model();
    }

    public function listar($col, $where) {

        $this->dataset['artigos'] = $this->read($col, $where);
        if ($this->dataset['artigos']) {
            $this->getMedia();
            $this->getCategoria();
            $this->getUsuario();
        }
        return $this->dataset;
    }
    
    public function single($col, $where){
        $trataArray = $this->listar($col, $where);    
        extract($trataArray);
        $this->dataset['artigos'] = $artigos[0];
        return $this->dataset;
        
    }

    public function salvar(Array $parametros) {

        $parametros['data'] = date('Y-m-d');
        $this->id = $this->insert($parametros);
    }

    public function excluir($parametros) {

        $this->delete($parametros);
        Transacao::executa();
    }

    public function atualiza($coluna, $condicao) {
        $this->update($coluna, $condicao);
    }

    private function getMedia() {

        foreach ($this->dataset['artigos'] as $artigos) {
            $this->model_media->id = ($artigos['media']) ? $artigos['media'] : 0;
            $this->model_media->mediaList(TRUE);
            $dataset_artigos[] = $this->model_media->relaciona($artigos);
//            $artigos['media_url'] = $this->model_media->url;
        }

        $this->updateDataset($dataset_artigos);
    }

    private function getCategoria() {

        foreach ($this->dataset['artigos'] as $artigos) {
            $this->model_categoria->singleCategoria($artigos['categoria']);
            $dataset_artigos[] = $this->model_categoria->relaciona($artigos);
        }
        $this->updateDataset($dataset_artigos);
    }

    private function getUsuario() {
        foreach ($this->dataset['artigos'] as $artigos) {
            $this->model_usuario->singleUsuario(null, ["id = " . $artigos['autor']]);
//            $artigos['autor_nome'] = $this->model_usuario->usuario_nome;
            $dataset_artigos[] = $this->model_usuario->relaciona($artigos);
        }
        $this->updateDataset($dataset_artigos);
//        var_dump($this->dataset);
    }

    private function updateDataset($dataset_artigos) {
        unset($this->dataset['artigos']);
        $this->dataset['artigos'] = $dataset_artigos;
    }

}
