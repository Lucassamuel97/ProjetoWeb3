<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

class LoginControlador extends Controlador
{
    public function criar()
    {   
        $this->visao('login/criar.php', [], 'simple.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarNome($_POST['nome']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])){
            DW3Sessao::set('usuario', $usuario->getId());
            if ($usuario->isAdmin()){
                $this->redirecionar(URL_RAIZ . 'home');
            } else {
                $this->redirecionar(URL_RAIZ . 'home');
            }

        }else{
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php', [], 'simple.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
