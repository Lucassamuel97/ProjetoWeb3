<?php
namespace Modelo;

use \Framework\DW3Modelo;

abstract class Modelo extends DW3Modelo
{
	public static function Criarpaginacao($pagina_atual, $total)
    {
        $limite = 5;
        $quant_pag = 10;
        $numero_de_paginas = floor( $total / $quant_pag);

        $paginas = null;

        if($pagina_atual != 0) {
        	$paginas .= "<li class='page-item'> <button class='page-link' value='0'>Primeira</button></li>";
        	$paginas .= "<li class='page-item'><button class='page-link' value='".($pagina_atual - 1)."'> < </button></li>";
        }

        for ($i = ($pagina_atual-1); $i <= ($pagina_atual - 1) + $limite; $i++) { 
            if ($i < $numero_de_paginas && $i > 0) {
                if (($i-1) == $pagina_atual){
                    $paginas .= "<li class='page-item active'><button class='page-link' value='".($i-1)."'>$i</button></li> ";
                }else{
                    $paginas .= "<li class='page-item'><button class='page-link' value='".($i-1)."'>$i</button></li>";
                }
            }
        }

        if (($numero_de_paginas - $pagina_atual) > 5) {
                $paginas .= "<li class='page-item'><button class='page-link' value='0' disabled>...</button> </li>";
        }

        $paginas .= "<li class='page-item'><button class='page-link' value='".$numero_de_paginas."'>".$numero_de_paginas."</button> </li>";

        if ($pagina_atual != $numero_de_paginas){
        	$paginas .= "<li class='page-item'><button class='page-link' value='".($pagina_atual + 1)."'> > </button></li>";
        }

        
        return $paginas;    
    }
}
