<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Modelo\Usuario;

class Devolucao extends Modelo
{
    
    const ATUALIZAR = 'UPDATE emprestimos SET status = :status WHERE id = :id';
    const BUSCAR_EMPRESTIMOS  = " SELECT emprestimos.id,date_format(`data`,'%d/%m/%Y') AS `data_formatada`,livros.titulo FROM emprestimos JOIN livros ON id_livro=livros.id WHERE id_usuario= :id AND emprestimos.STATUS= 0 ORDER BY data asc";
    const BUSCAR_ID = 'SELECT * FROM emprestimos WHERE id = :id';

    private $id_emprestimo;
    private $id_usuario;
    private $status;


    public function __construct(
        $id_emprestimo = null,
        $id_usuario    = null ,
        $status        = '0'
    ) {
        $this->id_emprestimo = $id_emprestimo;
        $this->id_usuario = $id_usuario;
        $this->status = $status;
    }


    // GETTERS

    public function getIdemprestimo()
    {
        return $this->id_emprestimo;
    }

    public function getIdusuario()
    {
        return $this->id_usuario;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // SETTERS

    public function setIdemprestimo($id_emprestimo)
    {
        $this->id_emprestimo = $id_emprestimo;
    }

    public function setIdusuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function salvar()
    {
        $this->devolucao();
    }

    public function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(':id', $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        $devolucao = new Devolucao(
            $registro['id'],
            $registro['id_usuario'],
            $registro['status']
        );

        return $devolucao;
    }

    private function devolucao()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(':status', $this->status       , PDO::PARAM_STR);
        $comando->bindValue(':id'    , $this->id_emprestimo, PDO::PARAM_STR);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if ($this->id_usuario == null) {
            $this->setErroMensagem('id_usuario', 'Selecione um usuario.');
        } elseif (Usuario::buscarId($this->id_usuario) == null) {
            $this->setErroMensagem('id_usuario', 'Usuario inválido.');
        } elseif($this->buscarId($this->id_usuario)){

        }
    }

    public static function buscarTodos($id , $filtro = [])
    {
        $quant_pag = 10;

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_EMPRESTIMOS);
        $comando->bindValue(':id', $id, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $total_registros = $comando->rowCount();

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
