<?php

namespace App\Models;

use GK\Model\Model;

class UsuariosSeguidores extends Model {

    private $id_usuario;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    
    public function seguirUsuario($id_usuario_seguindo) {
        $sql = " 
            INSERT INTO usuarios_seguindo (id_usuario, id_usuario_seguindo)
            VALUES (:id_usuario, :id_usuario_seguindo)";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':id_usuario_seguindo', $id_usuario_seguindo);
        $stmt->execute();

        return true;
    }

    public function deixarDeSeguirUsuario($id_usuario_seguindo) {
        $sql = " 
            DELETE FROM usuarios_seguindo
            WHERE id_usuario = :id_usuario
            AND id_usuario_seguindo = :id_usuario_seguindo";

        $stmt = $this->database->prepare($sql);
        $stmt->bindValue('id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue('id_usuario_seguindo', $id_usuario_seguindo);
        $stmt->execute();

        return true;
    }
}
