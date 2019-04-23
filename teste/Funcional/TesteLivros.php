<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Livros;
use \Framework\DW3BancoDeDados;

class TesteLivros extends Teste
{
    public function testeCriar()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'livros/criar');
        $this->verificarContem($resposta, 'Cadastro');
    }

    public function testeArmazenar()
    {

        $this->logarAdmin();
        
        $resposta = $this->post(URL_RAIZ . 'livros', [
            'titulo'      => 'A formiguinha e a neve',
            'autor'       => 'Monteiro lobato',
            'q_exemplares'=> '2',
            'ano'         => '2017',
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'livros/criar');
        $resposta = $this->get(URL_RAIZ . 'livros/criar');
        $this->verificarContem($resposta, 'Livro cadastrado com sucesso');
        $query = DW3BancoDeDados::query('SELECT * FROM livros WHERE titulo = "A formiguinha e a neve"');
        $bdLivros = $query->fetchAll();
        $this->verificar(count($bdLivros) == 1);
    }

    public function testeEditar()
    {

        $this->logarAdmin();
        
        $livro = new Livros(
                'Diario de um banana',
                'Autor desconhecido',
                '2',
                null,
                '2017'
        );

        $livro->salvar();

        $resposta = $this->get(URL_RAIZ . 'livros/' . $livro->getId() . '/editar');
        $this->verificarContem($resposta, 'Editar');
        $this->verificarContem($resposta, $livro->getId());
        $this->verificarContem($resposta, $livro->getTitulo());
        $this->verificarContem($resposta, $livro->getAutor());
        $this->verificarContem($resposta, $livro->getQ_exemplares());

    }
}