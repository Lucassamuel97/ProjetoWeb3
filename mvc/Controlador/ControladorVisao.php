<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

/* Métodos úteis da visão */
trait ControladorVisao
{
    /* Caso o campo tenha um erro, retorna a classe CSS de erro */
    protected function getErroCss($campoNome)
    {
        return $this->temErro($campoNome) ? ' is-invalid' : '';
    }
}
