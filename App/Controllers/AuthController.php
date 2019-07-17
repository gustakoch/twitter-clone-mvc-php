<?php

namespace App\Controllers;

use GK\Controller\Action;
use GK\Model\Container;

class AuthController extends Action {

    public function autenticar() {
        $classUsuario = Container::getModel('Usuario');

        $classUsuario->__set('email', $_POST['email']);
        $classUsuario->__set('senha', strtoupper(sha1(['senha'])));

        // Verificando se o e-mail e senha estão presentes no banco de dados
        $classUsuario->verificaSeUsuarioExiste();

        if ($classUsuario->__get('id') != '' && $classUsuario->__get('nome') != '') {
            session_start();

            $_SESSION['id'] = $classUsuario->__get('id');
            $_SESSION['nome'] = $classUsuario->__get('nome');

            header('Location: /timeline');
        } else {
            header('Location: /?login=error');
        }
    }

    public function sair() {
        session_start();
        session_destroy();
        header('Location: /');
    }

}
