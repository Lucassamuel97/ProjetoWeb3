<?php

namespace Controlador;

use \Modelo\Livros;
use \Framework\DW3Sessao;

class LivrosControlador extends Controlador
{
	public function index()
	{
		$this->verificarLogado();
		$this->visao('livros/index.php', [
			'usuario' => $this->getUsuario(),
			'livros'  => Livros::buscarTodosfiltro($_GET)
		]);
	}

	public function criar()
	{  
		$this->verificarLogado();
		$this->visao('livros/criar.php', [
			'usuario' => $this->getUsuario(),
			'sucesso' => DW3Sessao::getFlash('sucesso')
		]);
	}

	public function armazenar()
	{
		$this->verificarLogado();
		$livro = new Livros(
			trim($_POST['titulo']),
			trim($_POST['autor']),
			trim($_POST['q_exemplares']),
			trim($_POST['ano'])
		);

		if ($livro->isValido()){
			$livro->salvar();
			DW3Sessao::setFlash('sucesso', 'Livro cadastrado com sucesso.');
			$this->redirecionar(URL_RAIZ . 'livros/criar');
		} else {
			$this->setErros($livro->getValidacaoErros());
			$this->visao('livros/criar.php', [
				'usuario' => $this->getUsuario(),
				'sucesso' => null
			]);
		}
	}

	public function atualizar($id)
	{
		$this->verificarLogado();
		$livro = Livros::buscarId($id);
		$livro -> setTitulo($_POST['titulo']);
		$livro -> setAutor($_POST['autor']);
		$livro -> setQ_exemplares($_POST['q_exemplares']);
		$livro -> setAno($_POST['ano']);

		if ($livro->isValido()){
			$livro->salvar();
			DW3Sessao::setFlash('sucesso', 'Livro editado com sucesso.');
			$this->redirecionar(URL_RAIZ . 'livros/'.$livro->getId().'/editar');
		} else {
			$this->setErros($livro->getValidacaoErros());
			$this->visao('livros/editar.php', [
				'usuario' => $this->getUsuario(),
				'livro'   => $livro,
				'sucesso' => null
			]);
		}
	}

	public function mostrar($id)
	{	
		$this->verificarLogado();
		$livro = Livros::buscarId($id);
		$this->visao('livros/mostrar.php', [
			'usuario' => $this->getUsuario(),
			'livro'   => $livro
		]);
	}

	public function editar($id)
	{
		$this->verificarLogado();
		$livro = Livros::buscarId($id);
		$this->visao('livros/editar.php', [
			'usuario' => $this->getUsuario(),
			'livro'   => $livro,
			'sucesso' => DW3Sessao::getFlash('sucesso')
		]);
	}

	public function destruir($id)
	{
		$this->verificarLogado();
		Livros::destruir($id);
		$this->redirecionar(URL_RAIZ . 'livros');
	}

}