create table cliente_juridico(
    codigo_cliente_juridico SERIAL PRIMARY KEY,
    razao_social varchar(60) NOT NULL,
    nome_fantasia varchar(60) NOT NULL,
    email varchar(70) NOT NULL UNIQUE,
    senha varchar(256) NOT NULL,
    telefone varchar(14) NOT NULL,
    celular varchar(15) NOT NULL,
    cnpj varchar(60) NOT NULL,
    inscricao_municipal varchar(60) NOT NULL,
    inscricao_estadual varchar(70),
    isento_inscricao_estadual varchar(1),
    cep varchar(9) NOT NULL,
    endereco varchar(60) NOT NULL,
    numero int NOT NULL,
    complemento varchar(60),
    bairro varchar(60) NOT NULL,
    ponto_de_referencia varchar(200) NOT NULL,
    cidade varchar(70) NOT NULL,
    estado varchar(19) NOT NULL,
    ativo varchar(1) NOT NULL,
    datafiltro_juridico DATE NOT NULL
);

create table cliente_fisico(
    codigo_cliente_fisico SERIAL PRIMARY KEY,
    nome varchar(60) NOT NULL,
    sobrenome varchar(60) NOT NULL,
    email varchar(70) NOT NULL UNIQUE,
    senha varchar(256) NOT NULL,
    telefone varchar(14) NOT NULL, 
    celular varchar(15) NOT NULL,   
    sexo varchar (9) NOT NULL,
    cpf varchar(14) NOT NULL,
    rg varchar(13) NOT NULL,
    data_nasc DATE,
    cep varchar(9) NOT NULL,
    endereco varchar(60) NOT NULL,
    numero int NOT NULL,
    complemento varchar(60),
    bairro varchar(60) NOT NULL,
    ponto_de_referencia varchar(200) NOT NULL,
    cidade varchar(70) NOT NULL,
    estado varchar(19) NOT NULL,
    ativo varchar(1) NOT NULL,
    datafiltro_fisico DATE NOT NULL
);

create table profissional(
   codigo_profissional SERIAL PRIMARY KEY,
    nome varchar(60) NOT NULL,
    sobrenome varchar(60) NOT NULL,
    email varchar(70) NOT NULL UNIQUE,
    senha varchar(256) NOT NULL,
    telefone varchar(14) NOT NULL,
    celular varchar(15) NOT NULL, 
    sexo varchar (9) NOT NULL,   
    cpf varchar(14) NOT NULL,
    rg varchar(13) NOT NULL,
    data_nasc DATE,
    cep varchar(9) NOT NULL,
    endereco varchar(60) NOT NULL,
    numero int NOT NULL,
    complemento varchar(60),
    bairro varchar(60) NOT NULL,
    ponto_de_referencia varchar(200) NOT NULL,
    cidade varchar(70) NOT NULL,
    estado varchar(19) NOT NULL,
    datafiltro_profissional DATE NOT NULL
);

create table fale_conosco(
    ticket SERIAL PRIMARY KEY,
    nome varchar(60) NOT NULL,
    email varchar(60) NOT NULL,
    celular varchar(15) NOT NULL,
    assunto varchar(60) NOT NULL,
    duvida varchar(200) NOT NULL,
    respondido varchar(1) NOT NULL,
    datafiltro_fale_conosco DATE NOT NULL,
    codigo_cliente_fisico_FK int,
    codigo_cliente_juridico_FK int,
    codigo_profissional_FK int NOT NULL
);

create table pedido(
    codigo_pedido SERIAL PRIMARY KEY,
    status varchar(60) NOT NULL,
    tipo varchar(60) NOT NULL,
    nome_do_negocio varchar(70) NOT NULL,
    ramo_de_atuacao varchar(60) NOT NULL,
    p1_tipo varchar(70),
    p2_tipo varchar(70),
    p3_tipo varchar(70),
    quantidade int NOT NULL,
    descricao varchar(200) NOT NULL,
    valor_total varchar(60) NOT NULL,
    data_pedido DATE NOT NULL,
    data_entrega DATE NOT NULL,
    id_pedido_junto int NOT NULL,
    codigo_cliente_fisico_FK int,
    codigo_cliente_juridico_FK int,
    codigo_profissional_FK int NOT NULL,
    codigo_servico_FK int,
    codigo_consultoria_FK int
);

create table pagamento(
    codigo_pagamento SERIAL PRIMARY KEY,
    forma_pagamento varchar(2) NOT NULL,
    codigo_pedido_FK int NOT NULL,
    codigo_cliente_fisico_FK int,
    codigo_cliente_juridico_FK int,
    codigo_profissional_FK int NOT NULL,
    codigo_servico_FK int,
    codigo_consultoria_FK int
);

create table cartao_de_credito(
    codigo_cartao_de_credito SERIAL PRIMARY KEY,
    nomecartao varchar(256) NOT NULL,
    numerocartao varchar(256) NOT NULL,
    datadevencimento varchar(256) NOT NULL,
    cvv varchar(256) NOT NULL,
    valor_total varchar(60) NOT NULL,
    parcelas varchar(3) NOT NULL,
    id_pedido_junto int NOT NULL,
    codigo_pedido_FK int NOT NULL,
    codigo_cliente_fisico_FK int,
    codigo_cliente_juridico_FK int,
    codigo_profissional_FK int NOT NULL,
    codigo_servico_FK int,
    codigo_consultoria_FK int,
    codigo_pagamento_FK int NOT NULL
);

create table servico(
    codigo_servico SERIAL PRIMARY KEY,
    tipo varchar(70) NOT NULL,
    valor_inicial varchar(60) NOT NULL,
    disponibilidade varchar (1) NOT NULL,
    codigo_profissional_FK int NOT NULL,
    datafiltro_servico DATE NOT NULL
);

create table consultoria_social_media(
    codigo_consultoria SERIAL PRIMARY KEY,
    tipo varchar(60) NOT NULL,
    valor_inicial varchar(60) NOT NULL,
    disponibilidade varchar (1) NOT NULL,
    codigo_profissional_FK int NOT NULL,
    datafiltro_socialmedia DATE NOT NULL
);

create table personalizacao(
    codigo_personalizacao SERIAL PRIMARY KEY,
    categoria varchar(2),
    tipo varchar(60) NOT NULL,
    valor varchar(60) NOT NULL,
    disponibilidade varchar(1) NOT NULL,
    codigo_servico_FK int,
    codigo_profissional_FK int NOT NULL,
    codigo_consultoria_FK int
);

ALTER TABLE fale_conosco
ADD CONSTRAINT fk_codigo_cliente_juridico FOREIGN KEY (codigo_cliente_juridico_FK) REFERENCES cliente_juridico(codigo_cliente_juridico);
ALTER TABLE fale_conosco
ADD CONSTRAINT fk_codigo_cliente_fisico FOREIGN KEY (codigo_cliente_fisico_FK) REFERENCES cliente_fisico(codigo_cliente_fisico);
ALTER TABLE fale_conosco
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);

ALTER TABLE pedido
ADD CONSTRAINT fk_codigo_cliente_fisico FOREIGN KEY (codigo_cliente_fisico_FK) REFERENCES cliente_fisico(codigo_cliente_fisico);
ALTER TABLE pedido
ADD CONSTRAINT fk_codigo_cliente_juridico FOREIGN KEY (codigo_cliente_juridico_FK) REFERENCES cliente_juridico(codigo_cliente_juridico);
ALTER TABLE pedido
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);
ALTER TABLE pedido
ADD CONSTRAINT fk_codigo_servico FOREIGN KEY (codigo_servico_FK) REFERENCES servico(codigo_servico);
ALTER TABLE pedido
ADD CONSTRAINT fk_codigo_consultoria FOREIGN KEY (codigo_consultoria_FK) REFERENCES consultoria_social_media(codigo_consultoria);

ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_pedido FOREIGN KEY (codigo_pedido_FK) REFERENCES pedido(codigo_pedido);
ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_cliente_fisico FOREIGN KEY (codigo_cliente_fisico_FK) REFERENCES cliente_fisico(codigo_cliente_fisico);
ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_cliente_juridico FOREIGN KEY (codigo_cliente_juridico_FK) REFERENCES cliente_juridico(codigo_cliente_juridico);
ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);
ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_servico FOREIGN KEY (codigo_servico_FK) REFERENCES servico(codigo_servico);
ALTER TABLE pagamento
ADD CONSTRAINT fk_codigo_consultoria FOREIGN KEY (codigo_consultoria_FK) REFERENCES consultoria_social_media(codigo_consultoria);

ALTER TABLE servico
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);

ALTER TABLE consultoria_social_media
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);


ALTER TABLE personalizacao
ADD CONSTRAINT fk_codigo_profissional FOREIGN KEY (codigo_profissional_FK) REFERENCES profissional(codigo_profissional);
ALTER TABLE personalizacao
ADD CONSTRAINT fk_codigo_servico FOREIGN KEY (codigo_servico_FK) REFERENCES servico(codigo_servico);
ALTER TABLE personalizacao
ADD CONSTRAINT fk_codigo_consultoria FOREIGN KEY (codigo_consultoria_FK) REFERENCES consultoria_social_media(codigo_consultoria);

/* Cadastro do profissional */
INSERT INTO profissional (nome,sobrenome,email,senha,telefone,celular,sexo,cpf,rg,data_nasc,cep,endereco,numero,complemento,bairro,ponto_de_referencia,cidade,estado,datafiltro_profissional) VALUES ('Admin','Admin','bangubngdesign@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','(21) 1234-5678','(21) 91234-5678','m','400.289.221-23','40.028.922-1','2020-01-20','21780-240','Avenida Rio Branco',156,'','Centro da Cidade','Próximo ao banco Itaú','Rio de Janeiro','rj','2020-11-25');

/* Cadastro dos serviços */
INSERT INTO servico (tipo,valor_inicial,disponibilidade,codigo_profissional_fk,datafiltro_servico) VALUES ('Logotipo','100.00','S',1,'2020-11-25');
INSERT INTO servico (tipo,valor_inicial,disponibilidade,codigo_profissional_fk,datafiltro_servico) VALUES ('Animação 3D','100.00','S',1,'2020-11-25');
INSERT INTO servico (tipo,valor_inicial,disponibilidade,codigo_profissional_fk,datafiltro_servico) VALUES ('Criação de Identidade Visual','1000.00','S',1,'2020-11-25');
INSERT INTO consultoria_social_media (tipo,valor_inicial,disponibilidade,codigo_profissional_fk,datafiltro_socialmedia) VALUES ('Consultoria Social Media','500.00','S',1,'2020-11-25');

/* Personalizações de Logotipo */
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico-Intermediário','40.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Intermediário','100.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Avançado','200.00','S',1,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Escrito','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Letra desenhada','40.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Figura','100.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Avançado','200.00','S',1,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','45 dias','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','30 dias','40.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','15 dias','100.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','7 dias','200.00','S',1,1);

/* Personalizações de Animação 3D */
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico','0.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico-Intermediário','40.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Intermediário','100.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Avançado','200.00','S',2,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Rosto estático','0.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Rosto animado','40.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Figura animada','100.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Figura personalizada com cutscene','450.00','S',2,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','45 dias','0.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','30 dias','40.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','15 dias','100.00','S',2,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','7 dias','200.00','S',2,1);

/* Personalizações de Criação de Identidade Visual */
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico','0.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Básico-Intermediário','1500.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Intermediário','2000.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p1','Avançado','3000.00','S',3,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Layout básico','0.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Layout e cartão de visitas','1500.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Redes Sociais','2000.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p2','Layout, cartão de visitas e itens de escritório','3000.00','S',3,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','45 dias','0.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','30 dias','1500.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','15 dias','1800.00','S',3,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_servico_fk, codigo_profissional_fk
) VALUES ('p3','7 dias','3000.00','S',3,1);

/* Personalizações de Consultoria Social Media */
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p1','Básico','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p1','Básico-Intermediário','150.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p1','Intermediário','200.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p1','Avançado','300.00','S',1,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p2','Facebook','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p2','Twitter','1500.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p2','Instagram','2000.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p2','Todos (Facebook, Twitter e Instagram) ou dois deles','3000.00','S',1,1);

INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p3','7 dias de adesão','0.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p3','15 dias de adesão','1500.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p3','30 dias de adesão','1800.00','S',1,1);
INSERT INTO personalizacao (categoria, tipo, valor, disponibilidade, codigo_consultoria_fk, codigo_profissional_fk
) VALUES ('p3','90 dias de adesão','4000.00','S',1,1);