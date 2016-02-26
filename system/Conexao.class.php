<?php

/**
 * Cria a conexao com banco de dados
 *
 * @author adamo
 */
final class Conexao {
    
    private function __construct(){}
    
    static function abrir($ini){
        if(file_exists("system/{$ini}.ini")){
            $conf = parse_ini_file("system/{$ini}.ini");
            
        }else{
            die("Íxii!!! Arquivo de configuração não encontrado...");
        }
        
        if($con = new PDO("mysql:host={$conf['host']};dbname={$conf['banco']}", $conf['usuario'], $conf['senha']))
                return $con;
        else 
            die('Eita!!!! Falha na configuração do banco.....');
        
        
        
    } 
    
    
    
}
