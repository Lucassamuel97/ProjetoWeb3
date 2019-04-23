<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

class UsuarioControlador extends Controlador
{


    public function index()
    {
        $this->verificarLogado();
        if($this->verificarPermicao()){
            $this->visao('usuarios/index.php', [
                'usuario' => $this->getUsuario(),
                'registros'  => Usuario::buscarTodosfiltro($_GET)
            ]);
        }
    }

    public function criar()
    {
        $this->verificarLogado();
        if($this->verificarPermicao()){
            $this->visao('usuarios/criar.php', [
                'usuario' => $this->getUsuario(),
                'sucesso' => DW3Sessao::getFlash('sucesso')
            ]);
        }
    }

    public function armazenar()
    {
        $this->verificarLogado();

        if($this->verificarPermicao()){

            $usuario = new Usuario(                
                null,
                $_POST['nome'],
                $_POST['senha'],
                $_POST['admin'],
                $_POST['endereco'],
                $_POST['bairro'],
                $_POST['numero'],
                $_POST['rg'],
                $_POST['cpf'],
                $_POST['data_nasc']
            );
            
            if ($usuario->isValido()){
                $usuario->salvar();
                DW3Sessao::setFlash('sucesso', 'Usuario cadastrado com sucesso.');
                $this->redirecionar(URL_RAIZ . 'usuarios/criar');
            } else {
                $this->setErros($usuario->getValidacaoErros());
                $this->visao('usuarios/criar.php', [
                    'sucesso' => null,
                    'usuario' => $this->getUsuario()
                ]);
            }
        }
    }

    public function mostrar($id)
    {   
        $this->verificarLogado();
        if($this->verificarPermicao()){
            $registro = Usuario::buscarId($id);
            $this->visao('usuarios/mostrar.php', [
                'usuario' => $this->getUsuario(),
                'registro'   => $registro
            ]);
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();

        $usuario = $this->getUsuario();

        if($usuario->isAdmin()){
            $registro = Usuario::buscarId($id);
            $this->visao('usuarios/editar.php', [
                'usuario' => $this->getUsuario(),
                'registro'   => $registro,
                'sucesso' => DW3Sessao::getFlash('sucesso')
            ]);
        }else{
            if ($usuario->getId() == $id){
                $registro = Usuario::buscarId($id);
                $this->visao('usuarios/editar.php', [
                    'usuario' => $this->getUsuario(),
                    'registro'   => $registro,
                    'sucesso' => DW3Sessao::getFlash('sucesso')
                ]);
            }else{
                $this->redirecionar(URL_RAIZ . 'home');
            }
        }
    }
    
    public function atualizar($id)
    {

        $this->verificarLogado();

        $usuario = Usuario::buscarId($id);
        
        $usuario->setNome($_POST['nome']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setEndereco($_POST['endereco']);
        $usuario->setBairro($_POST['bairro']);
        $usuario->setNumero($_POST['numero']);
        $usuario->setRg($_POST['rg']);
        $usuario->setCpf($_POST['cpf']);
        $usuario->setDataNascimento($_POST['data_nasc']);
        $usuario->setAdmin($_POST['admin']);

        if ($usuario->isValido()){
            $usuario->salvar();
            DW3Sessao::setFlash('sucesso', 'usuario editado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuarios/'.$usuario->getId().'/editar');
        }else{
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/editar.php', [
                'usuario' => $this->getUsuario(),
                'registro'   => $usuario,
                'sucesso' => null
            ]);
        }
    }

    public function destruir($id)
    {

        $this->verificarLogado();
        
        Usuario::destruir($id);
        $this->redirecionar(URL_RAIZ . 'usuarios');
    }
}
