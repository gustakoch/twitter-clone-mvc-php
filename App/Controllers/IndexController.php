<?php

namespace App\Controllers;

use GK\Controller\Action;
use GK\Model\Container;

class IndexController extends Action {

    public function index() {
        $this->view->loginError = isset($_GET['login']) ? $_GET['login'] : '';
        $this->view->error = "";
        $this->render('index');
    }

    public function inscreverse() {
        $this->view->validacaoError = isset($_GET['cadastro']) ? $_GET['cadastro'] : '';
        $this->render('inscreverse');
    }

    public function registrar() {
        $usuario = Container::getModel('Usuario');
        
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', $_POST['senha']);

        $resultValidacao = $usuario->validarCadastro();

        if ($resultValidacao['ok'] == 1) {
            $usuario->__set('senha', strtoupper(sha1($_POST['senha'])));
            $usuario->save();
            $this->render('cadastro');
        } else {
            header('Location: /inscreverse?cadastro=error');
        }
    }
}
