create table usuarios(
idUsuario int(11) PRIMARY KEY AUTO_INCREMENT,
idCarrera int(11) not null,
nombres varchar(255) not null,
apellidos varchar(255) not null,
email varchar(255) not null,
password varchar(255) not null,
matricula varchar(255) not null,
telefono varchar(10) not null,
sexo varchar(255) not null,
cuatrimestre varchar(255) not null,
grupo varchar(255) not null
);

create table carreras(
idCarrera int(11) PRIMARY KEY AUTO_INCREMENT,
 carrera varchar(255) not null  
);

create table actividades_usuarios(
idActividadUsuario int(11) PRIMARY KEY AUTO_INCREMENT,
idActividad int(11) not null,
idUsuario int(11) not null,
estado int(1) not null,
liberacion int(1) not null
);

create table horarios(
idHorario int(11) primary key auto_increment,
idActividad int(11) not null,
dia varchar(255) not null,
 hora_inicio varchar(255) not null,
 hora_fin varchar(255) not null
);

create table actividades(
idActividad int(11) primary key auto_increment,
idInstructor int(11) not null,
actividad varchar(255) not null,
cupo int(11) not null,
lugar varchar(255) not null,
descripcion varchar(255) not null,
material varchar(255) not null,
publicar int(1) not null
);

create table instructores(
idInstructor int(11) PRIMARY KEY AUTO_INCREMENT,
nombre varchar(255) not null,
apellidos varchar(255) not null,
email varchar(255) not null,
password varchar(255) not null,
telefono varchar(10) not null,
tituloAcademico varchar(255) not null
);

create table publicaciones(
idPublicacion int(11) primary key auto_increment,
idInstructor int(11)  not null,
idActividad int(11) not null,
titulo varchar(255) not null,
descripcion varchar(255) not null,
 imagen varchar(255) not null
);

create table comentarios(
idComentario int(11) PRIMARY KEY AUTO_INCREMENT,
idPublicacion int(11) not null,
idUsuario int(11) not null,
comentario varchar(255) not null  
);

create table reacciones(
idReaccion int(11) PRIMARY KEY AUTO_INCREMENT,
idPublicacion int(11) not null,
idUsuario int(11) not null,
reaccion varchar(255) not null  
);

create table formatos(
idFormato int(11) primary key auto_increment,
url varchar(255) not null,
 formato varchar(255) not null 
);

create table tipo_actividad(
	idTipoActividad int(11) primary KEY auto_increment,
    tipoActividad varchar(255) not null
);

create table usuarios_login(
	idLogin int(11) primary key auto_increment,
    email varchar(255) not null,
    password varchar(255) not null
);