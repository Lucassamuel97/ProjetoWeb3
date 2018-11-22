<?php
namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Devolucao;
use \Framework\DW3Sessao;

class DevolucaoControlador extends Controlador
{
    public function index()
    {   
        $this->verificarLogado();
        $usuario = $this->getUsuario();

        $this->visao('devolucao/criar.php', [
            'usuario' => $usuario,
            'registros'  => Devolucao::buscarTodos($usuario->getId(), $_GET),
            'sucesso' => DW3Sessao::getFlash('sucesso')
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        
        $id_usuario = $this->getUsuario()->getId();

        $devolucao = Devolucao::buscarId($_POST['idemprestimo']);

        if ($devolucao->getIdusuario() == $id_usuario && $devolucao->isValido()){
            $devolucao->setStatus(1);
            $devolucao->salvar();
            DW3Sessao::setFlash('sucesso', 'Devolução realizada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'devolucao');
        }else{
            $this->setErros($devolucao->getValidacaoErros());
            $this->index();
        }
    }
}