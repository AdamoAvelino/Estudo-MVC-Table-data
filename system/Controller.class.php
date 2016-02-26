<?php

/**
 * Description of Controller
 *
 * @author adamo
 */
abstract class Controller {

    public $parans;
    public $evento;

    protected function view($arquivo, $var = null){
        if($var)
            extract($var);

        include VIEW."headeradmin.phtml";
        include VIEW."{$arquivo}.phtml";
        include VIEW."footeradmin.phtml";
    }
}
