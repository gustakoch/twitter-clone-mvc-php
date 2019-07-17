<?php

namespace App\Models;

use GK\Model\Model;

class Usuario extends Model {
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function save() {
        $sql = " 
            INSERT INTO usuarios (nome, email, senha)
            VALUES (:nome, :email, :senha)";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        return $this;
    }

    public function validarCadastro() {
        $result = array();
        $result['ok'] = 1;
        
        if (strlen($this->__get('nome')) <= 0) {
            $result['ok'] = 0;
            $result['msg'] = "Por favor, informe um nome de usuário...";
        } else if (strlen($this->__get('email')) <= 0) {
            $result['ok'] = 0;
            $result['msg'] = "Por favor, informe um e-mail...";
        } else if (strlen($this->__get('senha')) <= 0) {
            $result['ok'] = 0;
            $result['msg'] = "Por favor, informe a senha...";
        }

        return $result;
    }

    public function verificaSeUsuarioExiste() {
        $sql = " 
            SELECT id, nome, email 
            FROM usuarios 
            WHERE email = :email AND senha = :senha";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':senha', strtoupper(sha1($_POST['senha'])));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($usuario['id'] != '' && $usuario['nome'] != '') {
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);
        }

        return $this;
    }

    public function procurarUsuario() {
        $sql = " 
            SELECT u.id, u.nome, u.email,
                (SELECT count(*)
                FROM usuarios_seguindo as us
                WHERE us.id_usuario = :id
                AND us.id_usuario_seguindo = u.id) as seguindo 
            FROM usuarios as u
            WHERE u.nome LIKE :nome
            AND u.id != :id";
        
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getInfoUsuario() {
        $sql = "
            SELECT nome 
            FROM usuarios
            WHERE id = :id_usuario";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getTotalTweets() {
        $sql = "
            SELECT count(*) as total_tweets
            FROM tweets
            WHERE id_usuario = :id_usuario";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getTotalSeguindo() {
        $sql = "
            SELECT count(*) as total_seguindo
            FROM usuarios_seguindo
            WHERE id_usuario = :id_usuario";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getTotalSeguidores() {
        $sql = "
            SELECT count(*) as total_seguidores
            FROM usuarios_seguindo
            WHERE id_usuario_seguindo = :id_usuario";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }





}
