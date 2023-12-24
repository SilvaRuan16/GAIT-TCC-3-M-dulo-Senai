CREATE DATABASE gait;

USE gait; 

create table sigla (
	sigla_estado char (2) primary key not null,
    uf_estado varchar (20) not null
);
ALTER TABLE sigla MODIFY COLUMN uf_estado VARCHAR( 20 ); 
insert into sigla (sigla_estado, uf_estado) values ('AC','Acre'), ('AL', 'Alagoas'), ('AP', 'Amapá'), ('AM', 'Amazonas'), ('BA', 'Bahia'), ('CE', 'Ceará'), ('DF', 'Distrito Federal'), 
('ES', 'Espirito Santo'), ('GO', 'Goiás'), ('MA', 'Maranhão'), ('MT', 'Mato Grosso'), ('MS', 'Mato Grosso do Sul'), ('MG', 'Minas Gerais'), ('PA', 'Pará'), ('PB', 'Paraíba'), ('PR', 'Paraná'),
('PE', 'Pernambuco'), ('PI', 'Piauí'), ('RJ', 'Rio de Janeiro'), ('RN', 'Rio Grande do Sul'), ('RO', 'Rondônia'), ('RR', 'Roraima'), ('SC', 'Santa Catarina'), ('SP', 'São Paulo'),
('SE', 'Sergipe'), ('TO', 'Tocantins');
select * from sigla;

create table sts_fornecedor(
	cod char(10) primary key not null,
    sts varchar(15) not null
);
ALTER TABLE sts_fornecedor MODIFY COLUMN sts varchar( 15 );
insert into sts_fornecedor (cod, sts) values ('Ativo', 'Ativo'), ('Desativado', 'Desativado');
select * from sts_fornecedor;

CREATE TABLE fornecedor(
     cod_fornecedor INT PRIMARY KEY AUTO_INCREMENT,
     nome_fantasia VARCHAR( 50 ) NOT NULL,
     razao_social VARCHAR( 50 ) NOT NULL,
     cnpj CHAR( 14 ),
     telefone CHAR( 11 ) NOT NULL,
     email VARCHAR( 30 ) NOT NULL,
     cep INT NOT NULL,
     endereco VARCHAR( 50 ) NOT NULL,
     cidade VARCHAR( 50 ) NOT NULL,
     uf VARCHAR( 2 ) NOT NULL,
     n_endereco INT NOT NULL,
     bairro VARCHAR( 50 ) NOT NULL,
     status_fornecedor char(10),
     data TIMESTAMP
);

SELECT * FROM fornecedor WHERE nome_fantasia LIKE '%ltda%';
ALTER TABLE fornecedor MODIFY COLUMN nome_fantasia VARCHAR( 50 );
ALTER TABLE fornecedor MODIFY COLUMN razao_social VARCHAR( 50 );
ALTER TABLE fornecedor modify COLUMN cnpj bigint unique;
ALTER TABLE fornecedor MODIFY COLUMN telefone bigint;
ALTER TABLE fornecedor MODIFY COLUMN email VARCHAR( 60 ) not null;
ALTER TABLE fornecedor MODIFY COLUMN cep int (8) not null;
ALTER TABLE fornecedor MODIFY COLUMN endereco VARCHAR( 50 );
ALTER TABLE fornecedor MODIFY COLUMN cidade VARCHAR( 50 );
ALTER TABLE fornecedor MODIFY COLUMN uf VARCHAR( 2 );
ALTER TABLE fornecedor MODIFY COLUMN n_endereco int;
ALTER TABLE fornecedor MODIFY COLUMN bairro VARCHAR( 50 );
ALTER TABLE fornecedor MODIFY COLUMN status_fornecedor CHAR( 10 );


select * from fornecedor;
ALTER TABLE fornecedor MODIFY COLUMN uf CHAR( 2 );
ALTER TABLE fornecedor ADD CONSTRAINT fk_sigla FOREIGN KEY (uf) REFERENCES sigla (sigla_estado);
ALTER TABLE fornecedor ADD CONSTRAINT fk_sts_fornecedor FOREIGN KEY (status_fornecedor) REFERENCES sts_fornecedor (cod);
SELECT * FROM fornecedor;
ALTER TABLE fornecedor MODIFY COLUMN cep CHAR( 8 ) NOT NULL;

CREATE TABLE status_for(
	cod char(3) PRIMARY KEY NOT NULL,
    sts VARCHAR(20) NOT NULL
);
ALTER TABLE status_for MODIFY COLUMN sts VARCHAR( 20 );
ALTER TABLE fornecedor ADD CONSTRAINT fk_status_for FOREIGN KEY (status_fornecedor) REFERENCES status_for (cod);
INSERT INTO status_for (cod, sts) VALUES ('ati', 'ATIVO');
INSERT INTO status_for (cod, sts) VALUES ('des', 'DESATIVADO');

insert into fornecedor (nome_fantasia, razao_social, cnpj, telefone, email, cep, endereco, cidade, uf, n_endereco, bairro, status_fornecedor, data) 
values 
('ruan', 'empresa', '12345678909876', '27988045322', 'ruan.gsilva@gmail.com', '12345678', 'rua horacio joão nepomuceno', 'vila velha', 'BA', '13', 'Vila batista', 'ati', '2023.11.19');

SELECT cod_fornecedor, nome_fantasia, razao_social, cnpj, telefone, email, cep, endereco, cidade, uf, n_endereco, bairro, status_fornecedor, data FROM fornecedor 
inner join sigla on fornecedor.uf = sigla.sigla_estado INNER JOIN status_for ON fornecedor.status_fornecedor = status_for.cod;

CREATE TABLE statusProduto(
	cod char(10) PRIMARY KEY NOT NULL,
    sts VARCHAR(20) NOT NULL
);
ALTER TABLE statusProduto MODIFY COLUMN sts VARCHAR( 20 );
alter table statusProduto add column cod_categoria char(3) not null unique;
alter table statusProduto add column categoria varchar(20) not null;
alter table statusProduto drop column cod_categoria;
insert into statusProduto (cod, sts) values ('Ativo', 'Ativo'), ('Desativado', 'Desativado');
select * from statusProduto;

CREATE TABLE categoriaProduto(
	cod char(15) PRIMARY KEY NOT NULL,
    cat VARCHAR(20) NOT NULL
);
ALTER TABLE categoriaProduto MODIFY COLUMN cat VARCHAR( 20 );
insert into categoriaProduto (cod, cat) values ('Bolsas', 'Bolsas'), ('Blusas', 'Blusas'), ('Camisetas', 'Camisetas'), ('Calças', 'Calças');
delete from categoriaProduto where cod = 'Blusas';
insert into categoriaProduto (cod, cat) values ('Mochilas', 'Mochilas'), ('Necesserie', 'Necesserie'), ('Kits', 'Kits'), ('Canecas', 'Canecas'), ('Roupas','Roupas');
select * from categoriaProduto;
delete from categoriaProduto where cod = 'des';

CREATE TABLE produto(
     cod_produto INT PRIMARY KEY AUTO_INCREMENT,
     nome VARCHAR( 50 ),
     descricao VARCHAR( 50 ),
     quantidade INT,
     valor FLOAT,
     status_produto CHAR(10),
     categoria VARCHAR( 30 ),
     observacoes VARCHAR( 100 ),
     data TIMESTAMP,
     constraint fk_statusProduto foreign key (status_produto) references statusProduto (cod),
     constraint fk_categoriaProduto foreign key (categoria) references categoriaProduto (cod)
);
describe produto;
drop table produto;
ALTER TABLE produto MODIFY COLUMN nome VARCHAR( 50 );
ALTER TABLE produto MODIFY COLUMN descricao VARCHAR( 100 );
ALTER TABLE produto MODIFY COLUMN quantidade int;
ALTER TABLE produto MODIFY COLUMN valor float;
ALTER TABLE produto MODIFY COLUMN status_produto CHAR( 3 );
ALTER TABLE produto MODIFY COLUMN categoria VARCHAR( 30 );
alter table produto modify column categoria char(3) not null;
ALTER TABLE produto ADD CONSTRAINT fk_statusProduto FOREIGN KEY (status_produto) REFERENCES status_for (cod);
ALTER TABLE produto ADD CONSTRAINT fk_categoriaProduto FOREIGN KEY (categoria) REFERENCES categoriaProduto (cod);
insert into produto 
(nome, descricao, quantidade, valor, imagem, status_produto, categoria, observacoes, data) 
values 
('bolsa', 'bolsa feminina para sair', '1', '79.99', '', 'ati', 'cal', 'calça com qualidade', '2023.11.19');
SELECT cod_produto, nome, descricao, quantidade, valor, imagem, status_produto, categoria, observacoes, data FROM produto
INNER JOIN statusProduto ON produto.status_produto = statusProduto.cod inner join categoriaProduto on produto.categoria = categoriaProduto.cod;

create table pagForma(
	cod char (15) primary key not null,
    forma varchar (20) not null
);
alter table pagForma MODIFY COLUMN forma varchar( 20 );
insert into pagForma (cod, forma) values ('Á vista', 'Á vista'), ('Dinheiro', 'Dinheiro'), ('Crédito 2x', 'Crédito 2x'), ('Crédito 3x', 'Crédito 3x'), ('Débito', 'Débito');
select * from pagForma;

create table pTIPO(
	cod char (10) primary key not null,
    tipo varchar (20) not null
);
ALTER TABLE pTipo MODIFY COLUMN tipo VARCHAR( 20 );
insert into pTIPO (cod, tipo) values ('Física', 'Pessoa Física'), ('Júridica', 'Pessoa Júridica');
select * from pTIPO;

create table vendaSTATUS(
	cod char (13) primary key not null,
    sts varchar (20) not null
);
ALTER TABLE vendaSTATUS MODIFY COLUMN sts VARCHAR( 20 );
drop table vendaSTATUS;
insert into vendaSTATUS(cod, sts) values ('Vendido', 'Vendido'), ('Não Vendido', 'Não Vendido');
delete from vendaSTATUS where cod = 'Vendido';
select * from vendaSTATUS;

create table orcamentoSTATUS(
	cod char (13) primary key not null,
    sts varchar (15) not null
);
ALTER TABLE orcamentoSTATUS MODIFY COLUMN sts VARCHAR( 50 );
insert into orcamentoSTATUS (cod, sts) values ('Ativo', 'Ativo'), ('Desativado', 'Desativado');
select * from orcamentoSTATUS;

CREATE TABLE orcamento(
     cod_orcamento INT PRIMARY KEY AUTO_INCREMENT,
     id_cliente int not null,
     forma_pagamento VARCHAR( 20 ),
     valor FLOAT,
     status_venda VARCHAR( 11 ),
     status_orcamento VARCHAR( 10 ),
     descricao VARCHAR( 50 ),
     pedido varchar (50),
     data TIMESTAMP,
     constraint fk_pagForma foreign key (forma_pagamento) references pagForma (cod),
     constraint fk_vendaSTATUS foreign key (status_venda) references vendaSTATUS (cod),
     constraint fk_orcamentoSTATUS foreign key (status_orcamento) references orcamentoSTATUS (cod),
     constraint fk_cliente foreign key (id_cliente) references cliente (cod_cliente)
);
describe orcamento;
drop table orcamento;
alter table orcamento modify column descricao varchar(200);
SELECT cod_orcamento, pedido, valor, forma_pagamento, descricao, status_venda, status_orcamento, data FROM orcamento;
create view vw_orcamentos as select cod_orcamento,nome,forma_pagamento,valor,status_venda,status_orcamento,descricao,pedido,orcamento.data from orcamento inner join cliente on orcamento.id_cliente = cliente.cod_cliente;

select * from vw_orcamentos;
create table funcionarioStatus(
	cod char (10) not null primary key,
    sts varchar (15) not null
);
ALTER TABLE funcionarioStatus MODIFY COLUMN sts VARCHAR( 15 );
insert into funcionarioStatus (cod, sts) values ('Ativo', 'Ativo'), ('Desativado', 'Desativado');
select * from funcionarioStatus;

CREATE TABLE funcionario(
     cod_funcionario INT PRIMARY KEY AUTO_INCREMENT,
     nome VARCHAR( 50 ),
     data_nascimento DATE,
     cpf CHAR( 11 ),
     telefone CHAR( 11 ),
     email VARCHAR( 30 ),
     cep INT,
     rg INT,
     endereco VARCHAR( 50 ),
     cidade VARCHAR( 50 ),
     n_endereco INT,
     bairro VARCHAR( 50 ),
     status_funcionario CHAR(10),
     usuario VARCHAR( 25 ) unique,
     senha CHAR( 6 ),
     data TIMESTAMP,
     constraint fk_funcionarioStatus foreign key (status_funcionario) references funcionarioStatus (cod)
);

delete from funcionario where cod_funcionario = '11';
alter table funcionario modify column usuario varchar(10) unique;
alter table funcionario modify column rg int unique;
describe funcionario;
drop table funcionario;
ALTER TABLE funcionario ADD CONSTRAINT fk_funcionarioStatus FOREIGN KEY (status_funcionario) REFERENCES funcionarioStatus (cod);

insert into funcionario (usuario, senha) value ('ruanADM', '1604');
select usuario, senha from funcionario;
select * from funcionario;
select cod_funcionario, usuario, senha from funcionario;

ALTER TABLE funcionario MODIFY COLUMN cep CHAR( 8 ) NOT NULL;
ALTER TABLE funcionario MODIFY COLUMN rg CHAR( 8 ) NOT NULL;
ALTER TABLE funcionario MODIFY COLUMN email varchar( 60 ) NOT NULL;
ALTER TABLE funcionario ADD COLUMN adm BOOLEAN DEFAULT FALSE;
insert into funcionario (usuario, senha, adm) value ('ruanADM', '1604', TRUE);


create table clienteSTS(
	cod char (8) primary key not null,
    sts varchar (12)
);
insert into clienteSTS (cod, sts) values ('Ativo', 'Ativo'), ('Desativo', 'Desativado');

create table pessoaTIPO(
	cod char (12) primary key not null,
    tipo varchar (15) not null
);
ALTER TABLE pessoaTIPO MODIFY COLUMN tipo VARCHAR( 15 );
insert into pessoaTIPO (cod, tipo) values ('Física', 'Física'), ('Júridica', 'Júridica');

CREATE TABLE cliente(
     cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
     nome varchar (60),
     data_nascimento DATE,
     cpf CHAR( 11 ) unique,
     cnpj CHAR( 14 ),
     telefone CHAR( 11 ),
     email VARCHAR( 30 ),
     cep INT(8),
     rg INT(7),
     endereco VARCHAR( 50 ),
     cidade VARCHAR( 50 ),
     n_endereco INT,
     status_cliente CHAR( 10 ),
     bairro VARCHAR( 50 ),
     tipo_pessoa CHAR( 8 ),
     data TIMESTAMP,
     constraint fk_clienteSTS foreign key (status_cliente) references clienteSTS (cod),
     constraint fk_pessoaTIPO foreign key (tipo_pessoa) references pessoaTIPO (cod)
);
drop table cliente;

delete from orcamento where id_cliente = 'Ruan Gustavo Soares da Silva';

insert into cliente(nome_p, data_nascimento, cpf, cnpj, telefone, email, cep, rg, endereco, cidade, n_endereco, status_cliente, bairro, tipo_pessoa)
values
('Marcos', '2006.04.16', '22012033578', '11021200365589', '27988045322', 'ruan@gmail.com', '22325478', '1200478', 'rua horácio');

select * from cliente;
ALTER TABLE cliente MODIFY COLUMN cpf CHAR( 11 ) unique;
alter table cliente modify column email varchar(60) not null unique;
ALTER TABLE cliente MODIFY COLUMN cnpj CHAR( 14 );
ALTER TABLE cliente MODIFY COLUMN nome_fantasia CHAR( 8 ) NOT NULL;
ALTER TABLE cliente MODIFY COLUMN rg CHAR( 8 ) NOT NULL;
ALTER TABLE cliente MODIFY COLUMN status_cliente BOOLEAN DEFAULT TRUE;
ALTER TABLE cliente MODIFY COLUMN tipo_pessoa BOOLEAN DEFAULT TRUE;
delete from cliente where cod_cliente = 11;
create table sts_mat(
	cod char (10) primary key not null,
    sts varchar (15) not null
);
ALTER TABLE sts_mat MODIFY COLUMN sts VARCHAR( 15 );
insert into sts_mat (cod, sts) values ('Ativo', 'Ativo'), ('Desativado', 'Desativado');
select * from sts_mat;

create table cat(
	cod char (10) primary key not null,
    categoria_materia varchar (20) not null
);
ALTER TABLE cat MODIFY COLUMN categoria_materia VARCHAR( 20 );
insert into cat (cod, categoria_materia) values ('Linhas', 'Linhas'), ('Tecidos', 'Tecidos'), ('Botões', 'Botões');
insert into cat (cod, categoria_materia) values ('Papel Kraft','Papel Kraft'), ('Tinta','Tinta');
select * from cat;

CREATE TABLE materia_prima(
     cod_materia INT PRIMARY KEY AUTO_INCREMENT,
     nome VARCHAR( 50 ),
	 descricao VARCHAR( 50 ),
     quantidade INT,
     valor FLOAT,
     status VARCHAR( 10 ),
     categoria VARCHAR( 30 ),
     observacao VARCHAR( 100 ),
     data TIMESTAMP,
     constraint fk_sts_mat foreign key (status) references sts_mat (cod),
     constraint fk_cat foreign key (categoria) references cat (cod)
);

alter table materia_prima modify column categoria char (4);
alter table materia_prima add constraint fk_sts_mat foreign key (status) references sts_mat (cod);
alter table materia_prima add constraint fk_cat foreign key (categoria) references cat (cod);