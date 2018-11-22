<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'GET' => '\Controlador\UsuarioControlador#index',
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/?' => [
        'GET' => '\Controlador\UsuarioControlador#mostrar',
        'PATCH' => '\Controlador\UsuarioControlador#atualizar',
        'DELETE' => '\Controlador\UsuarioControlador#destruir',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/?/editar' => [
        'GET' => '\Controlador\UsuarioControlador#editar',
    ],
    '/home' => [
        'GET' => '\Controlador\Home#index',
    ],
    '/livros' => [
        'GET' => '\Controlador\LivrosControlador#index',
        'POST' => '\Controlador\LivrosControlador#armazenar',        
    ],
    '/livros/?' => [
        'GET' => '\Controlador\LivrosControlador#mostrar',
        'PATCH' => '\Controlador\LivrosControlador#atualizar',
        'DELETE' => '\Controlador\LivrosControlador#destruir',
    ],
    '/livros/criar' => [
        'GET' => '\Controlador\LivrosControlador#criar',
    ],
    '/livros/?/editar' => [
        'GET' => '\Controlador\LivrosControlador#editar',
    ],
    '/emprestimo' => [
        'POST' => '\Controlador\EmprestimoControlador#armazenar',
    ],
    '/emprestimo/criar' => [
        'GET' => '\Controlador\EmprestimoControlador#criar',
    ],
    '/devolucao' => [
        'POST' => '\Controlador\DevolucaoControlador#armazenar',
        'GET' => '\Controlador\DevolucaoControlador#index',
    ],
    '/relatorio' => [
        'GET' => '\Controlador\RelatorioEmprestimoControlador#index',
    ],
];
