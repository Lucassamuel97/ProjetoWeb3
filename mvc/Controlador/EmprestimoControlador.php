<?php
namespace Controlador;

use \Modelo\Livros;
use \Modelo\Emprestimo;
use \Framework\DW3Sessao;

class EmprestimoControlador extends Controlador
{
    public function criar()
    {   
        $this->verificarLogado();
        $usuario = $this->getUsuario();
        $this->visao('emprestimos/criar.php', [
            'usuario' => $usuario,
            'livros'  => Livros::buscarTodosfiltro($_GET , $usuario->getId()),
            'sucesso' => DW3Sessao::getFlash('sucesso'),
            'erros' => DW3Sessao::getFlash('erros')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $usuario = $this->getUsuario();
        $emprestimo = new Emprestimo(
            $usuario->getId(),
            $_POST['livro'],
            date('Y-m-d')
        );

        if ($emprestimo->isValido()){
            $emprestimo->salvar();
            DW3Sessao::setFlash('sucesso', 'Emprestimo realizado com sucesso.');
        }else{
            $this->setErros($emprestimo->getValidacaoErros());
            DW3Sessao::setFlash('erros', $emprestimo->getValidacaoErros());
        }
        $this->redirecionar(URL_RAIZ . 'emprestimo/criar');
    }
}