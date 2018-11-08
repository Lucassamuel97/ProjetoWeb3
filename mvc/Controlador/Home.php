<?php
namespace Controlador;

use \Framework\DW3Sessao;

class Home extends Controlador
{
    public function index()
    {


        $this->verificarLogado();
        // $this->visao('home/index.php');

        $this->visao('home/index.php', [
            'usuario' => $this->getUsuario()
        ]);
    }


}
