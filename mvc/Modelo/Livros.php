<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Livros extends Modelo
{   
    const BUSCAR_ID     = 'SELECT * FROM livros WHERE id = :id';
    const BUSCAR_FILTRO = 'SELECT * FROM livros WHERE TRUE';
    const INSERIR       = 'INSERT INTO livros(titulo, autor, q_exemplares, ano) VALUES (:titulo, :autor, :q_exemplares, :ano)';
    const ATUALIZAR     = 'UPDATE livros SET titulo = :titulo, autor = :autor, q_exemplares = :q_exemplares, ano = :ano WHERE id = :id';
    const DELETAR       = 'DELETE FROM livros WHERE id = :id';
    private $id;
    private $titulo;
    private $autor;
    private $q_exemplares;
    private $q_emprestados;
    private $ano;

    public function __construct(
        $titulo        = null,
        $autor         = null,
        $q_exemplares  = null,
        $q_emprestados = null,
        $ano           = null,
        $id            = null
    ){
        $this->titulo        = $titulo;
        $this->autor         = $autor;
        $this->q_exemplares  = $q_exemplares;
        $this->q_emprestados = $q_emprestados;
        $this->ano           = $ano;
        $this->id            = $id;
    }


    ######### GETTERS #########
    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getQ_exemplares()
    {
        return $this->q_exemplares;
    }

    public function getQ_emprestados()
    {
        return $this->q_emprestados;
    }

    public function getAno()
    {
        return $this->ano;
    }


    ######### SETTERS #########

    public function setTitulo($titulo)
    {
        $this->titulo = trim($titulo);
    }

    public function setAutor($autor)
    {
        $this->autor = trim($autor);
    }

    public function setQ_exemplares($q_exemplares)
    {
        $this->q_exemplares = trim($q_exemplares);
    }

    public function setQ_emprestados($q_emprestados)
    {
        $this->q_emprestados = trim($q_emprestados);
    }

    public function setAno($ano)
    {
        $this->ano = trim($ano);
    }

    ######### Methods #########

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(':titulo',       $this->titulo       , PDO::PARAM_STR);
        $comando->bindValue(':autor' ,       $this->autor        , PDO::PARAM_STR);
        $comando->bindValue(':q_exemplares', $this->q_exemplares , PDO::PARAM_STR);
        $comando->bindValue(':ano',          $this->ano          , PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(':titulo',       $this->titulo       , PDO::PARAM_STR);
        $comando->bindValue(':autor' ,       $this->autor        , PDO::PARAM_STR);
        $comando->bindValue(':q_exemplares', $this->q_exemplares , PDO::PARAM_STR);
        $comando->bindValue(':ano',          $this->ano          , PDO::PARAM_STR);
        $comando->bindValue(':id',           $this->id           , PDO::PARAM_STR);
        $comando->execute();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(':id' , $id , PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarTodosfiltro($filtro = [], $iduser = null)
    {   
        $sqlWhere = '';
        $parametros = [];
        $quant_pag = 10;

        if (array_key_exists('titulo', $filtro) && trim($filtro['titulo']) != ''){
            $parametros[] = $filtro['titulo'];
            $sqlWhere .= " AND livros.titulo like ?";
        }
        if (array_key_exists('autor', $filtro) && trim($filtro['autor']) != ''){
            $parametros[] = $filtro['autor'];
            $sqlWhere .= " AND livros.autor like ?";
        }
        if (array_key_exists('ano', $filtro) && trim($filtro['ano']) != ''){
            $parametros[] = $filtro['ano'];
            $sqlWhere .= " AND livros.ano like ?";
        }
        if ($iduser != null){
            $sqlWhere .= " AND livros.id not in (select id_livro from emprestimos where id_usuario = ? AND status = 0) AND q_exemplares >= (SELECT COUNT(*) FROM emprestimos WHERE id_livro = livros.id AND STATUS = 0 )";
        }

        $sql = self::BUSCAR_FILTRO . $sqlWhere;


        $comando = DW3BancoDeDados::prepare($sql);

        for ($i=0; $i < count($parametros) ; $i++) { 
            $comando->bindValue($i +1, "%".$parametros[$i]."%", PDO::PARAM_STR);
        }

        if ($iduser != null){
            $comando->bindValue($i + 1, $iduser , PDO::PARAM_STR);
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

        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Livros(
                $registro['titulo'],
                $registro['autor'],
                $registro['q_exemplares'],
                $registro['q_emprestados'],
                $registro['ano'],
                $registro['id']
            );
        }

        $objetos[] = [
            'paginacao' => $paginacao
        ];

        return $objetos;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(':id', $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Livros(
            $registro['titulo'],
            $registro['autor'],
            $registro['q_exemplares'],
            $registro['q_emprestados'],
            $registro['ano'],
            $registro['id']
        );
    }

    protected function verificarErros()
    {
        if ($this->titulo == null || strlen($this->titulo) > 200){
            $this->setErroMensagem('titulo', 'O campo título deve ter entre 1 e 200 caracteres.');
        }
        if ($this->ano == null || $this->ano < -4000 || $this->ano > date('Y')){
            $this->setErroMensagem('ano', 'O campo ano deve ser entre -4000 e '.date('Y'));
        }
        if (strlen($this->autor) < 10 || strlen($this->autor) > 100){
            $this->setErroMensagem('autor', 'O campo autor deve ter entre 10 e 100 caracteres.');
        }
        if ($this->q_exemplares < 1 || $this->q_exemplares > 1000){
            $this->setErroMensagem('q_exemplares', 'A quantidade de exemplares deve ser entre 1 e 1000.');
        }
    }
}
