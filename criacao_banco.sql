-- Banco de dados utlizado: Mysql

-- Criação do banco de dados 'backend_genion'
create database backend_genion;

use backend_genion;

-- Criação da tabela 'categorias'
create table categorias (
    codigo varchar(10) primary key not null,
    nome varchar(50) not null
);

-- Criação da tabela 'produtos'
create table produtos (
    nome varchar(100) not null,
    sku varchar(10) primary key not null,
    preco float not null,
    descricao text,
    quantidade int not null,
    categorias varchar(100) not null,
    image_name varchar(50)
);