<?php

namespace App\Controllers;

use GK\Controller\Action;
use GK\Model\Container;

class AppController extends Action {

    public function validarAutenticacao() {
        session_start();
        
        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location: /?login=error');
        }
    }

    public function timeline() {
        $this->validarAutenticacao();

        $this->view->validaTweet = isset($_GET['tweet']) ? $_GET['tweet'] : '';
       
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_usuario', $_SESSION['id']);

        $allTweets = $tweet->listarTweets();
        $this->view->tweets = $allTweets;

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        
        $this->view->infoUsuario = $usuario->getInfoUsuario();
        $this->view->totalTweets = $usuario->getTotalTweets();
        $this->view->totalSeguindo = $usuario->getTotalSeguindo();
        $this->view->totalSeguidores = $usuario->getTotalSeguidores();

        $this->render('timeline');
    }

    public function tweet() {
        $this->validarAutenticacao();

        $tweet = Container::getModel('Tweet');
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);

        if ($tweet->validarTweet()) {
            $tweet->salvarTweet();
            header('Location: /timeline');
        } else {
            header('Location: /timeline?tweet=error');
        }
    }
 
    public function quemSeguir() {
        $this->validarAutenticacao();

        $usuarios = array();
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);

        $pesquisa = isset($_GET['search']) ? $_GET['search'] : '';
        
        if ($pesquisa != '') {
            $usuario->__set('nome', $pesquisa);
            $usuarios = $usuario->procurarUsuario();
        }

        $this->view->infoUsuario = $usuario->getInfoUsuario();
        $this->view->totalTweets = $usuario->getTotalTweets();
        $this->view->totalSeguindo = $usuario->getTotalSeguindo();
        $this->view->totalSeguidores = $usuario->getTotalSeguidores();
        
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }

    public function acao() {
        $this->validarAutenticacao();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $id_usuario_seguindo = isset($_GET['id']) ? $_GET['id'] : '';

        $usuario = Container::getModel('UsuariosSeguidores');
        $usuario->__set('id_usuario', $_SESSION['id']);

        if ($acao == 'seguir') {
            $usuario->seguirUsuario($id_usuario_seguindo);
        } else if ($acao == 'deixarDeSeguir') {
            $usuario->deixarDeSeguirUsuario($id_usuario_seguindo);
        }
        header('Location: /quem_seguir');
    }

    public function removerTweet() {
        $this->validarAutenticacao();

        $classTweet = Container::getModel('Tweet');
        $classTweet->__set('id', $_GET['id_tweet']);

        $classTweet->excluir();
        header('Location: /timeline');
    }
}
