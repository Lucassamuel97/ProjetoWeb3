<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogarAdmin()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'admin',
            'senha' => 'admin'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLogarNaoAdmin()
    {   
        ( new Usuario(
         null,
         "jose",
         "1234",
         '',
         "Endereco teste",
         "bairro teste",
         "12",
         "123213123",
         "123213123213",
         "1997-08-08"
         ))->salvar();

        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'jose',
            'senha' => '1234'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeDeslogar()
    {
        ( new Usuario(
         null,
         "jose",
         "1234",
         '',
         "Endereco teste",
         "bairro teste",
         "12",
         "123213123",
         "123213123213",
         "1997-08-08"
         ))->salvar();

        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'jose',
            'senha' => '1234'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
