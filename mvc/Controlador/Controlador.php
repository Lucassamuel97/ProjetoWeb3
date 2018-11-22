<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{   
    protected $usuario;

    use ControladorVisao;
    
	protected function verificarLogado($admin = false)
    {
    	$usuario = $this->getUsuario();
        if ($usuario == null || ($admin && !$usuario->isAdmin()) ) {
        	$this->redirecionar(URL_RAIZ . 'login');
        }
    }

    protected function verificarPermicao()
    {
        $usuario = $this->getUsuario();
        if ($usuario->isAdmin()){
            return true;
        }else{
            $this->redirecionar(URL_RAIZ . 'home');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
        	$usuarioId = DW3Sessao::get('usuario');
        	if ($usuarioId == null) {
        		return null;
        	}
        	$this->usuario = Usuario::buscarId($usuarioId);
        }
        return $this->usuario;
    }
}
