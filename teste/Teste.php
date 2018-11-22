<?php
namespace Teste;

use \Modelo\Usuario;
use \Framework\DW3Teste;
use \Framework\DW3Sessao;

abstract class Teste extends DW3Teste
{
	public function logarAdmin()
	{
		DW3Sessao::set('usuario', 1);
	}

	public function logarNormal()
	{
			$usuario = new Usuario(
               null,
               "teste",
               "12345",
               '',
               "Endereco teste",
               "bairro teste",
               "12",
               "123213123",
               "123213123213",
               "1997-08-08"
                );
			$usuario->salvar();
			DW3Sessao::set('usuario', $usuario->getId());
	}
}
