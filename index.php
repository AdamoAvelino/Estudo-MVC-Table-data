<?php

define('CONTROLLER', 'app/controller/');
define('MODEL', 'app/model/');
define('VIEW', 'app/view/');

define('CONTROLLER_ADMIN', 'app_admin/controller/');
define('MODEL_ADMIN', 'app_admin/model/');
define('VIEW_ADMIN', 'app_admin/view/');

include 'system/Transacao.class.php';
include 'system/Conexao.class.php';
include 'system/System.class.php';
include 'system/Controller.class.php';
include 'system/Model.class.php';

function __autoload($classe) {
    $include = array(MODEL, CONTROLLER);
    foreach ($include as $diretorio) {

        if (file_exists($diretorio . "{$classe}.class.php")) {
            include $diretorio . "{$classe}.class.php";
        }
    }
}

$system = new System();
$system->run();
