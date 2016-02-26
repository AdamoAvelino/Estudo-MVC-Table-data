<?php

/**
 * Description of Model_Admin
 *
 * @author adamo
 */
class Model_Autenticacao extends Model{
    
    public function autentica($email, $senha){
        $this->tabela = 'usuarios';
        return $this->read(['email, senha'], ["email = '$email' ", "AND senha = '$senha'"]);
    }
    
    public function cadastrar(Array $campos){
        $this->insert($campos);
    }
    
}
