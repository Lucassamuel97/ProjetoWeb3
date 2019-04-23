<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteEmprestimos extends Teste
{
    public function testeCriar()
    {
        $this->logarNormal();
        $resposta = $this->get(URL_RAIZ . 'emprestimo/criar');
        $this->verificarContem($resposta, 'Empréstimo');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'emprestimo/criar');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeArmazenar()
    {
        $this->logarNormal();
        $resposta = $this->post(URL_RAIZ . 'emprestimo', [
            'livro' => '1'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'emprestimo/criar');
        $query = DW3BancoDeDados::query('SELECT * FROM emprestimos');
        $bdEmprestimos = $query->fetchAll();
        $this->verificar(count($bdEmprestimos) == 1);
    }
    
}