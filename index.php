<?php

define('CONTROLLER', 'app/controller/');
define('MODEL', 'app/model/');
define('VIEW', 'app/view/');
define('HELPERS', 'system/helpers/');

include 'system/Transacao.class.php';
include 'system/Conexao.class.php';
include 'system/System.class.php';
include 'system/Controller.class.php';
include 'system/Model.class.php';

function __autoload($classe) {
    $include = array(MODEL, CONTROLLER, HELPERS);
    foreach ($include as $diretorio) {

        if (file_exists($diretorio . "{$classe}.class.php")) {
            include $diretorio . "{$classe}.class.php";
        }
    }
}

$system = new System();
$system->run();
