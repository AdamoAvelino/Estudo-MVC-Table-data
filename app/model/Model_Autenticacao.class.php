<?php

/**
 * Descrição: Model_Admin
 * Ler e insere usuarios a tabela de banco de dados.
 * @author adamo
 */
class Model_Autenticacao extends Model{

    /*
    * Metodo Construtor, carrega o construct da classe pai, a fim garantir a trasação com oo banco de dados.
    */

    function __construct(){

        parent::__construct();

        $this->tabela = 'usuarios';
    }

    /*
    * Envia uma solicitção ao banco de dados, para trazer possiveis registros de usuarios
    */

    public function autentica($email, $senha){
        $this->tabela = 'usuarios';
        return $this->read(['email, senha'], ["email = '$email' ", "AND senha = '$senha'"]);
    }

    /*
    * Insere novos usuarios ao banco de dados.
    */
    public function cadastrar(Array $campos){
        $this->insert($campos);
        Transacao::executa();
    }

}
