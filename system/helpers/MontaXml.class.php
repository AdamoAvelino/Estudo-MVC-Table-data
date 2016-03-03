<?php
/**
*
*/
class MontaXml
{
    private $doc;
    function __construct()
    {
        $this->doc = new DOMDocument('1.0');
    }

    public function montarDocumento($conteudo, $pai){
       /* $doc  = new DOMDocument('1.0');*/
        $this->doc->preserveWhiteSpace = TRUE;
        $raiz = $this->doc->createElement($pai);
        foreach ($conteudo as $dados) {
            extract($dados);
             $tag = $this->doc->createElement('nome');
             $tag->setAttribute('value', $id);
             $tag->setAttribute('tag', $nome);
             $raiz->appendChild($tag);
        }

        $this->doc->appendChild($raiz);
       return $this->doc->saveXML();
    }
}