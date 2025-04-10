create database db_moleza_imoveis;

use db_moleza_imoveis;

create table tb_tipo_usuario (
cd_tipo_usuario tinyint auto_increment primary key,
nm_tipo_usuario varchar(30) not null unique
);

create table tb_usuario (
cd_usuario smallint auto_increment primary key,
nm_usuario varchar(80) not null,
nm_email varchar(60) not null unique,
cd_senha char(64) not null,
st_usuario char(1) not null default "1",
dt_registro_usuario datetime not null default current_timestamp,
id_tipo_usuario tinyint not null,
foreign key (id_tipo_usuario) 
references tb_tipo_usuario (cd_tipo_usuario)
);

insert into tb_tipo_usuario set
nm_tipo_usuario = 'corretor';

select * from tb_usuario;

create table tb_tipo_imovel (
cd_tipo_imovel tinyint auto_increment primary key,
nm_tipo_imovel varchar(60) not null unique
);

create table tb_cidade (
cd_cidade int auto_increment primary key,
nm_cidade varchar(80) not null,
sg_estado char(2) not null
);

create table tb_imovel (
cd_imovel int auto_increment primary key,
nm_endereco varchar(150) not null,
nr_imovel varchar(20) not null,
ds_complemento varchar(80),
nm_bairro varchar(80) not null,
id_cidade int not null,
cd_postal varchar(10) not null,
id_tipo_imovel tinyint not null,
qt_suite tinyint default '0',
qt_sala_estar tinyint default '0',
qt_quarto tinyint default '0',
qt_banheiro tinyint default '0',
qt_lavabo tinyint default '0',
qt_vaga_garagem tinyint default '0',
qt_sala_jantar tinyint default '0',
qt_cozinha tinyint default '0',
ic_area_externa char(1) default '0',
ic_piscina char(1) default '0',
ic_edicula char(1) default '0',
ic_churrasqueira char(1) default '0',
ds_imovel longtext not null,
id_proprietario int not null,
dt_registro_imovel datetime not null default current_timestamp,
id_usuario_registro smallint not null,
foreign key (id_cidade) references tb_cidade (cd_cidade),
foreign key (id_tipo_imovel) references tb_tipo_imovel (cd_tipo_imovel),
foreign key (id_usuario_registro) references tb_usuario (cd_usuario)
);

create table tb_proprietario (
cd_proprietario int auto_increment primary key,
nm_proprietario varchar(80) not null,
nr_telefone varchar(15) not null,
nm_email varchar(60) not null unique,
dt_registro_proprietario datetime default current_timestamp,
id_corretor smallint not null,
foreign key (id_corretor) references tb_usuario (cd_usuario)
);

alter table tb_imovel add
foreign key (id_proprietario) references tb_proprietario (cd_proprietario);

create table tb_tipo_negocio (
cd_tipo_negocio tinyint auto_increment primary key,
nm_tipo_negocio varchar(60) not null unique
);

create table tb_negocio_imovel (
cd_negocio_imovel int auto_increment primary key,
id_imovel int not null,
id_tipo_negocio tinyint not null,
vl_negocio decimal(12,2) not null,
foreign key (id_imovel) references tb_imovel (cd_imovel),
foreign key (id_tipo_negocio) references tb_tipo_negocio (cd_tipo_negocio)
);

create table tb_imagem_imovel (
cd_imagem int auto_increment primary key,
id_imovel int not null,
url_imagem varchar(150) not null,
dt_registro_imagem datetime default current_timestamp,
foreign key (id_imovel) references tb_imovel (cd_imovel)
);


insert into tb_usuario set
    nm_usuario = 'Claudio',
    nm_email = 'claudio@mail.com',
    cd_senha = sha2('123', 256),
    id_tipo_usuario = 1;

