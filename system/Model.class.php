<?php

/**
 * Description of Model
 *
 * @author adamo
 */
abstract class Model {
    private $con;
    protected $tabela;
    protected $dataset;
    public  $id;

    public function __construct(){

        $banco = Transacao::abrir('banco');
        $this->con = Transacao::getCon();

        if(!$this->con){
            die('Falha na conexão do banco');
        }
    }


    protected function read(Array $coluna = null, Array $where = null, $order = null, $limit = null, $offset = null){
        $col = ($coluna) ? implode(', ',$coluna) : '*';
        $cond = ($where) ? ' WHERE '.implode(' ', $where) : '';
        $ord = ($order) ? " ORDER BY {$order}" : "";
        $lim = ($limit) ? " LIMIT {$limit}" : "";
        $off = ($offset) ? " OFFSET {$offset}" : "";
        $query = $this->con->query("SELECT {$col} FROM {$this->tabela} {$cond} {$ord} {$lim} {$off}");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $this->dataset = $query->fetchAll();
        return $this->dataset;

    }

    protected function readSingle(Array $coluna = null, Array $where = null, $order = null, $limit = null, $offset = null){
        $col = ($coluna) ? implode(', ',$coluna) : '*';
        $cond = ($where) ? ' WHERE '.implode(' ', $where) : '';
        $ord = ($order) ? " ORDER BY {$order}" : "";
        $lim = ($limit) ? " LIMIT {$limit}" : "";
        $off = ($offset) ? " OFFSET {$offset}" : "";
        $query = $this->con->query("SELECT {$col} FROM {$this->tabela} {$cond} {$ord} {$lim} {$off}");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $this->dataset = $query->fetch();
        $this->id = ($this->id) ? NULL : $this->id;
        return $this->dataset;

    }

    protected function insert($campos){
        $this->getLast();
        $campos['id'] = $this->id;
        $cols = implode(',', array_keys($campos));
        $vals = "'".implode("','", array_values($campos))."'";
        $sql = "INSERT INTO $this->tabela ($cols) values($vals)";
        $this->con->query($sql);
        return $this->id;

    }

    protected function update(Array $campos, Array $where){
        $val = $col = array();
        foreach($campos as $coluna => $valor){
              $sets[] = "$coluna = '$valor'";

        }

        $sql = "UPDATE {$this->tabela} SET ".implode(', ', $sets)." WHERE ".implode(' ', $where);
        $this->con->query($sql);

    }

    protected function delete(Array $condicao){
        $sql = "DELETE FROM $this->tabela WHERE ".implode(' ', $condicao);
        $this->con->query($sql);
    }

    private function getLast(){
       $query = $this->con->query("SELECT (id + 1) incremento FROM {$this->tabela} ORDER BY id DESC LIMIT 1");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $dataset = $query->fetch();
        extract($dataset);
        $this->id = $incremento;

    }
}
