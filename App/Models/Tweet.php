<?php

namespace App\Models;

use GK\Model\Model;

class Tweet extends Model {
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvarTweet() {
        $sql = " 
            INSERT INTO tweets (id_usuario, tweet)
            VALUES (:id_usuario, :tweet)";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();

        return $this;
    }

    public function validarTweet() {
        $result = true;

        if (strlen(trim($this->__get('tweet'))) < 3) {
            $result = false;
        }

        return $result;
    }

    public function listarTweets() {
        $sql = "
            SELECT t.id as id_tweet, t.id_usuario, t.tweet, u.nome, DATE_FORMAT (t.data, '%d/%m/%Y %H:%i') as data
            FROM tweets t
            INNER JOIN usuarios u ON (t.id_usuario = u.id)
            WHERE id_usuario = :id_usuario
            OR t.id_usuario
            IN (SELECT id_usuario_seguindo FROM usuarios_seguindo WHERE id_usuario = :id_usuario)
            ORDER BY t.data DESC";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function excluir() {
        $sql = " 
            DELETE FROM tweets
            WHERE id = :id";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return true;
    }
}
