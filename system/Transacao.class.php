<?php

/**
 *
 *
 * @author adamo
 */
final class Transacao {

    private static $con;

    private function __construct(){}

    public static function abrir($arquivo){
        if(empty(self::$con)){
            self::$con = Conexao::abrir($arquivo);
            self::$con->beginTransaction();
        }

    }

    public static function executa(){

        self::$con->commit();
        self::$con = null;

    }

    public static function abortar(){

        self::$con->rollback();
        self::$con = null;
    }

    public static function getCon(){
        return self::$con;
    }

}
