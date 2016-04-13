<?php
/**
*
*/
class Artigos_Model extends Model
{
    public $id;
    public $model_categoria;
    public $media;
    private $dataset;

    function __construct()
    {
        parent::__construct();
        $this->tabela = 'artigos';
        $this->model_categoria = new Categoria_Model();
        /*$this->categorias = $model_categoria->listaCategorias(TRUE);*/
        $this->model_media = new Media_Model();
    }

    public function salvar(Array $parametros){
        
        $parametros['data'] = date('Y-m-d');
        $parametros['autor'] = $_SESSION['nome'];
        $this->id = $this->insert($parametros);
    }

    public function listar($col, $where){

        $this->dataset['artigos']  = $this->read($col, $where);
        if($this->dataset['artigos']){
            $this->getCategoria();
            $this->getMedia();
        }
        return $this->dataset;

    }

    public function single($col = null, $where){
            $this->dataset['artigos'] = $this->readSingle($col, $where);
            $this->dataset['categorias'] = $this->model_categoria->listaCategorias(TRUE);
            if($this->dataset['artigos']['media']){
                $this->model_media->id = $this->dataset['artigos']['media'];
                $this->dataset['medias'] = $this->model_media->mediaList();
            }
            return $this->dataset;
    }

    public function excluir($parametros){

        $this->delete($parametros);
        Transacao::executa();
    }

    public function atualiza($coluna, $condicao){
        $this->update($coluna, $condicao);

    }

    private function getMedia(){
                foreach ($this->dataset['artigos'] as $artigos) {
                    $this->model_media->id = ($artigos['media']) ? $artigos['media'] : 0;
                    $this->model_media->mediaList(TRUE);
                    $artigos['media_url'] =  $this->model_media->url;
                    $dataset_artigos[] = $artigos;
                }
                $this->updateDataset($dataset_artigos);
    }

     private function getCategoria(){

            foreach ($this->dataset['artigos'] as $artigos) {
                   $this->model_categoria->singleCategoria($artigos['categoria']);
                   $artigos['nome_categoria'] = $this->model_categoria->categoria_nome;
                   $dataset_artigos[] = $artigos;

            }
            $this->updateDataset($dataset_artigos);
     }

     private function updateDataset($dataset_artigos){
        unset($this->dataset['artigos']);
        $this->dataset['artigos'] = $dataset_artigos;
     }

}