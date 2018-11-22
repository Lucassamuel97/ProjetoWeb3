<?php
namespace Controlador;

use \Modelo\RelatorioEmprestimos;

class RelatorioEmprestimoControlador extends Controlador
{
    public function index()
    {
    	$this->verificarLogado();
    	
        $this->visao('relatorios/emprestimos.php', [
        	'usuario' => $this->getUsuario(),
            'registros' => RelatorioEmprestimos::buscarRegistros($_GET,$this->getUsuario())
        ]);
    }
}
