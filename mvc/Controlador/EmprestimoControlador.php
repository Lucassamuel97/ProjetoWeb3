<?php
namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Livros;
use \Modelo\Emprestimo;
use \Framework\DW3Sessao;

class EmprestimoControlador extends Controlador
{
    public function criar()
    {   

        $usuario = $this->getUsuario();

        $this->visao('emprestimos/criar.php', [
            'usuario' => $usuario,
            'livros'  => Livros::buscarTodosfiltro($_GET , $usuario->getId()),
            'sucesso' => DW3Sessao::getFlash('sucesso')
        ]);
    }

    public function armazenar()
    {
        $emprestimo = new Emprestimo(
            $_POST['usuario'],
            $_POST['livro'],
            date('Y-m-d')
        );

        if ($emprestimo->isValido()) {
            $emprestimo->salvar();
            DW3Sessao::setFlash('sucesso', 'Emprestimo realizado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'emprestimo/criar');
        
        }else{
            $this->setErros($venda->getValidacaoErros());
            $this->visao('emprestimo/criar', [
                'usuario' => $this->getUsuario(),
                'livros'  => Livros::buscarTodosfiltro($_GET),
                'sucesso' => null
            ]);
        }
    }
}