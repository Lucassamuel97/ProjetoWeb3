<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Modelo\Usuario;
use \Modelo\Livros;

class Emprestimo extends Modelo
{
    const INSERIR   = 'INSERT INTO emprestimos(id_usuario, id_livro, data, status) VALUES (:id_usuario, :id_livro, :data, :status)';
    const DEVOLUCAO = 'UPDATE emprestimos SET status = :status WHERE id = :id';
    const DELETAR   = 'DELETE FROM emprestimos WHERE id = :id';

    private $id;
    private $id_usuario;
    private $id_livro;
    private $data;
    private $status;

    public function __construct(
        $id_usuario = null,
        $id_livro   = null,
        $data      = null,
        $status    = 0,
        $id        = null
    ) {
        $this->id        = $id;
        $this->id_usuario= $id_usuario;
        $this->id_livro  = $id_livro;
        $this->data      = $data;
        $this->status    = $status;
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
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
        $comando->bindValue(':id_livro'  , $this->id_livro  , PDO::PARAM_STR);
        $comando->bindValue(':data'      , $this->data      , PDO::PARAM_STR);
        $comando->bindValue(':status'    , $this->status    , PDO::PARAM_STR);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if ($this->id_usuario == null) {
            $this->setErroMensagem('id_usuario', 'Selecione um usuario.');
        } elseif (Usuario::buscarId($this->id_usuario) == null) {
            $this->setErroMensagem('id_usuario', 'Usuario inválido.');
        }

        if ($this->id_livro == null) {
            $this->setErroMensagem('id_livro', 'Selecione um usuario.');
        } elseif (Livros::buscarId($this->id_livro) == null) {
            $this->setErroMensagem('id_livro', 'Usuario inválido.');
        }
    }
}
