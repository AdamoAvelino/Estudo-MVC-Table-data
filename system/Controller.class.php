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
/*var_dump($var);*/
        if(is_array($var)){
             /*var_dump($var); die();*/
            extract($var, EXTR_PREFIX_ALL, 'view');
        }

        include VIEW."headeradmin.phtml";
        include VIEW."{$arquivo}.phtml";
        include VIEW."footeradmin.phtml";
    }
}
