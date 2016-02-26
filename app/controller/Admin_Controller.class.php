<?php

/**
 * Description of Admin_Controler
 *
 * @author adamo
 */
class Admin_Controller extends Controller{

    public function index_action(){

        $this->view('admin');
    }

    public function login(){
        $this->view('login');

    }

}
