<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Devolucao;
use \Modelo\Emprestimo;
use \Framework\DW3BancoDeDados;

class TesteDevolucao extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario(                
            null,
            "Nometeste",
            "123456"
        );

        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeDevolver()
    {
        $emprestimo = new Emprestimo(
            $this->usuarioId,
            "1",
            date('Y-m-d')
        );

        $emprestimo->salvar();

        $query = DW3BancoDeDados::query("SELECT * FROM emprestimos WHERE id = " . $emprestimo->getId());
        $bdEmprestimo = $query->fetch();
        $this->verificar($bdEmprestimo['status'] == "0");

        $devolucao = Devolucao::buscarId($emprestimo->getId());

        $devolucao->setStatus(1);
        
        $devolucao->salvar();

        $query = DW3BancoDeDados::query("SELECT * FROM emprestimos WHERE id = " . $emprestimo->getId());
        $bdEmprestimo = $query->fetch();
        $this->verificar($bdEmprestimo['status'] == "1");
    }
}