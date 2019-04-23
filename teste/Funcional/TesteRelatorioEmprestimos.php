<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteRelatorioEmprestimos extends Teste
{
    public function testeIndex()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'relatorio');
        $this->verificarContem($resposta, 'Livros mais Emprestados');
    }
}
