drop database  if exists Postales;
create database Postales;
use Postales;
create table admini(
	idAdmin int(10) primary key not null auto_increment,
    contra varchar(30),
    email varchar(30)
);
create table usuario(
	idUsuario int(10) primary key not null auto_increment,
	nombreUsuario varchar(100),
    apellidoUsuario varchar(100),
    genero varchar(100),
	contra varchar(30),
	email varchar(30)
);

create table categorias(
	idCategoria int(10) primary key not null auto_increment,
    nombreCategoria varchar(100)
);


create table papel(
		idPapel int(10) primary key not null auto_increment,
    img varchar(150),
    idCategoria int(10),
    nombrePapel varchar(150),
		foreign key idCategoria references categorias(idCategoria);
);

create table enviados(
	idEnviados int(10) primary key not null auto_increment,
    idRemitente int(10) not null,
    idDestinatario int(10) not null,
    mensaje varchar(500) not null,
    vista int(2),
    idPapel int(10),
		fecha date,
		foreign key idPapel references papel(idPapel)
);
