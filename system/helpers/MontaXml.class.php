<?php
/**
*
*/
class MontaXml
{
    private $elemento;
    private $doc;
    private $conteudo;
    private $raiz;
    function __construct()
    {
        $this->doc = new DOMDocument('1.0');
    }

    public function montarDocumento($conteudo, $pai, $elemento){
       /* $doc  = new DOMDocument('1.0');*/
        $this->elemento = $elemento;
        $this->conteudo = $conteudo;
        $this->doc->preserveWhiteSpace = TRUE;
        $this->raiz = $this->doc->createElement($pai);
        $this->getElemento();
        $this->doc->appendChild($this->raiz);
        return $this->doc->saveXML();
    }

    private function getElemento(){
       $metodo = 'elemento'.ucfirst($this->elemento);
       $this->$metodo();
    }


    private function elementoOption(){
        foreach ($this->conteudo as $dados) {
            extract($dados);
             $tag = $this->doc->createElement('nome');
             $tag->setAttribute('value', $id);
             $tag->setAttribute('tag', $nome);
             $this->raiz->appendChild($tag);
        }
    }

    private function elementoMedia(){
         foreach ($this->conteudo as $dados) {
            extract($dados);
             $tag = $this->doc->createElement('nome');
             $tag->setAttribute('id', $id);
             $tag->setAttribute('src', $url);
             $tag->setAttribute('mine', $tipo);
             $this->raiz->appendChild($tag);
    }
}

}