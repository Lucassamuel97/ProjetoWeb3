<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Cadastro');
    }

    public function testeArmazenar()
    {

        $this->logarAdmin();
        
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'nome'     => 'joao da silva',
            'senha'    => '123456',
            'admin'    => '0',
            'endereco' => 'endereco teste',
            'bairro'   => 'bairro teste',
            'numero'   => '123',
            'rg'       => '12321312312',
            'cpf'      => '213123232',
            'data_nasc'=> '1997-08-08'
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/criar');
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Usuario cadastrado com sucesso');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "joao da silva"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }

    public function testeEditar()
    {

        $this->logarAdmin();
        
        $usuario = new Usuario(                
                null,
                "Lucas teste",
                "123456",
                "1",
                "endereco",
                "bairro",
                "12",
                "123123213",
                "3213213123",
                "1997-08-08"
        );

        $usuario->salvar();

        $resposta = $this->get(URL_RAIZ . 'usuarios/' . $usuario->getId() . '/editar');
        $this->verificarContem($resposta, 'Editar');
        $this->verificarContem($resposta, $usuario->getNome());
        $this->verificarContem($resposta, $usuario->getEndereco());
        $this->verificarContem($resposta, $usuario->getBairro());
        $this->verificarContem($resposta, $usuario->getNumero());
        $this->verificarContem($resposta, $usuario->getRg());
        $this->verificarContem($resposta, $usuario->getDataNascimento());
        $this->verificarContem($resposta, $usuario->getCpf());
    }
}