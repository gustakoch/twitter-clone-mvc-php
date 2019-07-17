<?php

namespace GK\Model;

abstract class Model {
    protected $database;
    
    // Quando vc instanciar a classe Produto, vc precisa passar a variável que conterá a conexão com o banco de dados
    public function __construct(\PDO $database) {
        $this->database = $database;
    }
}
