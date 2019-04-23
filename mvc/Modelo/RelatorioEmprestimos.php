<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class RelatorioEmprestimos extends Modelo
{
    const BUSCAR_TODOS = 'SELECT livros.id, titulo,autor,COUNT(*) emprestimos FROM emprestimos JOIN livros ON livros.id=id_livro';

    public static function buscarRegistros($filtro = [], $usuario)
    {
        $sqlWhere  = '';
        $quant_pag = 10;
        
        if (!$usuario->isAdmin()){
            $sqlWhere .= ' WHERE id_usuario= :id ';
        }
        
        $sql = self::BUSCAR_TODOS . $sqlWhere . ' GROUP BY id_livro';
        
        $comando = DW3BancoDeDados::prepare($sql);
        
        if (!$usuario->isAdmin()){
            $comando->bindValue(':id', $usuario->getId(), PDO::PARAM_STR);
        }

        $comando->execute();
        $total_registros = $comando->rowCount();
        $registros = $comando->fetchAll();


        if (!empty($filtro['pagina'] )){
            $pag_atual = $filtro['pagina'];
        }else{
            $pag_atual = 0;
        }

        if($total_registros > $quant_pag){
            $registros = array_slice($registros, $pag_atual * $quant_pag, $quant_pag);                                    
            $paginacao =  self::Criarpaginacao( $pag_atual, $total_registros);
        }else{
            $paginacao = "";
        }

        $registros[] = [
            'paginacao' => $paginacao
        ];

        
        return $registros;
    }
}
