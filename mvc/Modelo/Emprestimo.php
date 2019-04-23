<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Modelo\Usuario;
use \Modelo\Livros;

class Emprestimo extends Modelo
{
    const INSERIR  = 'INSERT INTO emprestimos(id_usuario, id_livro, data, status) VALUES (:id_usuario, :id_livro, :data, :status)';
    const DELETAR  = 'DELETE FROM emprestimos WHERE id = :id';
    const VERIFICA = 'SELECT * FROM emprestimos WHERE id_livro = :id_livro AND id_usuario = :id_usuario AND emprestimos.status = 0';
    const AC_QUANT_LIVRO = 'UPDATE livros SET q_emprestados = q_emprestados + 1 WHERE livros.id = :id_livro;';

    private $id;
    private $id_usuario;
    private $id_livro;
    private $data;
    private $status;

    public function __construct(
        $id_usuario = null,
        $id_livro   = null,
        $data       = null,
        $status     = 0,
        $id         = null
    ) {
        $this->id         = $id;
        $this->id_usuario = $id_usuario;
        $this->id_livro   = $id_livro;
        $this->data       = $data;
        $this->status     = $status;
    }


    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getUsuarioid()
    {
        return $this->id_usuario;
    }

    public function getLivroid()
    {
        return $this->id_livro;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatus()
    {
        return $this->status;
    }


    // SETTERS
    public function setUsuarioid($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setLivroid($id_livro)
    {
        $this->id_livro = $id_livro;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function salvar()
    {
        if ($this->id == null){
            $this->inserir();
        } else {
            $this->devolucao();
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();

        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
        $comando->bindValue(':id_livro'  , $this->id_livro  , PDO::PARAM_STR);
        $comando->bindValue(':data'      , $this->data      , PDO::PARAM_STR);
        $comando->bindValue(':status'    , $this->status    , PDO::PARAM_STR);
        $comando->execute();

        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        
        $comando = DW3BancoDeDados::prepare(self::AC_QUANT_LIVRO);
        $comando->bindValue(':id_livro'    , $this->id_livro   , PDO::PARAM_STR);
        $comando->execute();

        DW3BancoDeDados::getPdo()->commit();
    }

    private function verifica_usuario_emprestimos()
    {
        $comando = DW3BancoDeDados::prepare(self::VERIFICA);
        $comando->bindValue(':id_livro'  , $this->id_livro  , PDO::PARAM_STR);
        $comando->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
        $comando->execute();

        return $comando->rowCount();
    }

    protected function verificarErros()
    {
        if ($this->id_usuario == null) {
            $this->setErroMensagem('id_usuario', 'Selecione um usuario.');
        } elseif (Usuario::buscarId($this->id_usuario) == null) {
            $this->setErroMensagem('id_usuario', 'Usuario inválido.');
        }

        if ($this->id_livro == null) {
            $this->setErroMensagem('id_livro', 'Selecione o livro.');
        } elseif (Livros::buscarId($this->id_livro) == null) {
            $this->setErroMensagem('id_livro', 'Livro inválido.');
        } else{
            $livro = Livros::buscarId($this->id_livro);
            if ($livro->getQ_emprestados() >= $livro->getQ_exemplares()){
                 $this->setErroMensagem('id_livro', 'Livro indisponível');
            }
        }
    
        if ($this->verifica_usuario_emprestimos() > 0) {
            $this->setErroMensagem('id_livro', 'Erro: este usuário já possui um empréstimo desta obra');
        }

    }
}
