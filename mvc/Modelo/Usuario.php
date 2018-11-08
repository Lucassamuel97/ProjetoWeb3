<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_ID   = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_NOME = 'SELECT * FROM usuarios WHERE nome = ?';
    const INSERIR     = 'INSERT INTO usuarios(nome, senha, admin, endereco, bairro, numero, rg, cpf, data_nasc) VALUES (:nome, :senha, :admin, :endereco, :bairro, :numero, :rg, :cpf, :data_nasc)';
    const ATUALIZAR   = 'UPDATE usuarios SET nome = :nome, senha = :senha, admin = :admin, endereco = :endereco, bairro = :bairro , numero = :numero, rg = :rg , cpf = :cpf , data_nasc = :data_nasc WHERE id = :id';
    const BUSCAR_FILTRO = 'SELECT * FROM usuarios WHERE TRUE';
    const DELETAR       = 'DELETE FROM usuarios WHERE id = :id';

    private $id;
    private $nome;
    private $senha;
    private $endereco;
    private $bairro;
    private $numero;
    private $rg;
    private $cpf;
    private $data_nasc;
    private $senhaPlana;
    private $admin;

    public function __construct(
        $nome       = null,
        $senhaPlana = null,
        $id         = null,
        $admin      = false
    ){
        $this->nome       = $nome;
        $this->senhaPlana = $senhaPlana;
        $this->admin      = $admin;
        $this->senha      = password_hash($senhaPlana, PASSWORD_BCRYPT);
        $this->id         = $id;
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getDataNascimento()
    {
        return $this->data_nasc;
    }


    // SETTERS
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public  function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setRg($rg){
        $this->rg = $rg;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setDataNascimento($data_nasc){
        $this->data_nasc = $data_nasc;
    }

    public function setAdmin($admin){
        $this->admin = $admin;
    }

    public function setSenha($senhaPlana)
    {
        $this->senhaPlana = $senhaPlana;
        $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public function salvar()
    {
        if ($this->id == null){
            $this->inserir();
        } else {
            $this->atualizar();
        }
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(':nome'     , $this->nome     , PDO::PARAM_STR);
        $comando->bindValue(':senha'    , $this->senha    , PDO::PARAM_STR);
        $comando->bindValue(':admin'    , $this->admin    , PDO::PARAM_STR);
        $comando->bindValue(':endereco' , $this->endereco , PDO::PARAM_STR);
        $comando->bindValue(':bairro'   , $this->bairro   , PDO::PARAM_STR);
        $comando->bindValue(':numero'   , $this->numero   , PDO::PARAM_STR);
        $comando->bindValue(':rg'       , $this->rg       , PDO::PARAM_STR);
        $comando->bindValue(':cpf'      , $this->cpf      , PDO::PARAM_STR);
        $comando->bindValue(':data_nasc', $this->data_nasc, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(':nome'     , $this->nome     , PDO::PARAM_STR);
        $comando->bindValue(':senha'    , $this->senha    , PDO::PARAM_STR);
        $comando->bindValue(':admin'    , $this->admin    , PDO::PARAM_STR);
        $comando->bindValue(':endereco' , $this->endereco , PDO::PARAM_STR);
        $comando->bindValue(':bairro'   , $this->bairro   , PDO::PARAM_STR);
        $comando->bindValue(':numero'   , $this->numero   , PDO::PARAM_STR);
        $comando->bindValue(':rg'       , $this->rg       , PDO::PARAM_STR);
        $comando->bindValue(':cpf'      , $this->cpf      , PDO::PARAM_STR);
        $comando->bindValue(':data_nasc', $this->data_nasc, PDO::PARAM_STR);
        $comando->bindValue(':id'       , $this->id       , PDO::PARAM_STR);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        $usuario = new Usuario(
            $registro['nome'],
            null,
            $registro['id'],
            $registro['admin']
        );
        $usuario->setEndereco($registro['endereco']);
        $usuario->setBairro($registro['bairro']);
        $usuario->setNumero($registro['numero']);
        $usuario->setRg($registro['rg']);
        $usuario->setCpf($registro['cpf']);
        $usuario->setDataNascimento($registro['data_nasc']);

        return $usuario;
    }

    public static function buscarNome($nome)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();
        $usuario = null;
        if ($registro) {
            $usuario = new Usuario(
                $registro['nome'],
                null,
                $registro['id'],
                $registro['admin']
            );
            $usuario->senha = $registro['senha'];
        }
        return $usuario;
    }

    protected function verificarErros()
    {
        if ($this->nome == null || strlen($this->nome) > 50){
            $this->setErroMensagem('nome', 'O campo nome deve ter entre 1 e 50 caracteres.');
        }
        if ($this->senhaPlana == null){
            $this->setErroMensagem('senha', 'O campo senha não pode ser nulo.');
        }
    }

    public static function buscarTodosfiltro($filtro = [])
    {   
        $sqlWhere = '';
        $parametros = [];
        $quant_pag = 10;

        if (array_key_exists('nome', $filtro) && trim($filtro['nome']) != ''){
            $parametros[] = $filtro['nome'];
            $sqlWhere .= " AND usuarios.nome like ?";
        }

        if (!empty($filtro['pagina'] )){
            $pag_atual = $filtro['pagina'];
        }else{
            $pag_atual = 0;
        }

        $sql = self::BUSCAR_FILTRO . $sqlWhere;
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro){
            $comando->bindValue($i +1, "%$parametro%", PDO::PARAM_STR);
        }

        $comando->execute();
        $total_registros = $comando->rowCount();
        $registros = $comando->fetchAll();

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

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(':id' , $id , PDO::PARAM_INT);
        $comando->execute();
    }
}
