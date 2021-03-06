<?php

/**
 *
 */
class Media_Model extends Model {

    private $img;
    public $url;
    private $arquivo;
    private $copia = 'copia';
    private $dataset;
    public $id;

    function __construct() {
        parent::__construct();
        $this->tabela = 'media';
        $this->url = '/web-admin/imagens/';
    }

    public function incluir() {
        $this->verificaArquivo();
        $this->armazenaArquivo();
        $this->id = $this->insert(['tipo' => 'imagem', 'url' => $this->url . $this->img]);
    }

    public function mediaList($server = null) {

        $where = (($this->id) ? ['id = ' . $this->id] : null);
        if ($server and $where) {
            $this->dataset = $this->readSingle(null, $where);
        } else {

            $this->dataset = $this->read(null, $where);
        }
        return $this->dataset;
    }

    private function verificaArquivo() {
        $this->img = $_FILES['imagem_input']['name'];
        $diretorio = opendir('.' . $this->url);
        while ($arquivos = readdir($diretorio)) {
            if ($arquivos == $this->img) {
                $this->arquivo = true;
                $nome_copia = explode('.', $this->img);
                $this->img = $nome_copia[0] . '_' . $this->copia . '.' . $nome_copia[1];
            }
        }
    }

    private function armazenaArquivo() {
        move_uploaded_file($_FILES['imagem_input']['tmp_name'], '.' . $this->url . $this->img);
    }

    public function relaciona($array) {
        if (!isset($this->dataset[0])) {
            extract($this->dataset);
            $array['tipo_media'] = $tipo;
            $array['media_url'] = $url;
        }
        return $array;
    }

}
