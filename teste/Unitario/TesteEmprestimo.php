<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Emprestimo;
use \Framework\DW3BancoDeDados;

class TesteEmprestimo extends Teste
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

    public function testeInserir()
    {
        $emprestimo = new Emprestimo(
            $this->usuarioId,
            "1",
            date('Y-m-d')
        );

        $emprestimo->salvar();

        $query = DW3BancoDeDados::query("SELECT * FROM emprestimos WHERE id = " . $emprestimo->getId());
        $bdEmprestimo = $query->fetch();
        $this->verificar($bdEmprestimo['id_livro'] === $emprestimo->getLivroid());
    }
}