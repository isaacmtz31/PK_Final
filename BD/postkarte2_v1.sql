drop database  if exists Postales;
create database Postales;
use Postales;

drop table if exists admini;
create table admini(
	idAdmin int(10) primary key not null auto_increment,
    contra varchar(32),
    email varchar(60)
);
drop table if exists usuario;
create table usuario(
	idUsuario int(10) primary key not null auto_increment,
	nombreUsuario varchar(100) not null,
    apellidoUsuario varchar(100) not null,
    genero varchar(15) not null,
	contra varchar(32) not null,
	email varchar(60) unique not null, 
    edad int(2) not null,
    fotoPerfil varchar(500) default './../imgs/users/user4.jpg',
    fechaRegistro datetime default current_timestamp
);
drop table if exists categorias;
create table categorias(
	idCategoria int(10) primary key not null auto_increment,
    nombreCategoria varchar(100),    
    imagen nvarchar(300) null default './../imgs/categorias/categoria1.jpg',
    conteo int(4) not null default 0 /* cuenta las postales enviadas pertenecientes a esta categoria */
);

create table papel
(
	idPapel int(10) primary key not null auto_increment,
    nombrePapel varchar(150),
	img varchar(150) default './../imgs/papeles/papel1.jpg'  
);

drop table if exists karte;
create table karte
(
	idKarte int(3) primary key not null,
    nombreK nvarchar(50) not null, 
    descripcion nvarchar(200) not null, 
    idPapel int(3) not null, 
    enviados int(4) not null default 0,    
    FOREIGN KEY  (idPapel) REFERENCES papel(idPapel) on update cascade on delete cascade
);

 /* Tabla para conocer enviados/recibidos */
drop table if exists relUsuarioKarte;
create table relUsuarioKarte
(
	idEnviados int(10) primary key not null auto_increment,
    idRemitente int(10) not null,
    idDestinatario int(10) not null,
    idKarte int(3) not null,
    FOREIGN KEY (idRemitente) REFERENCES usuario(idUsuario) on update cascade on delete cascade,
    FOREIGN KEY (idDestinatario) REFERENCES usuario(idUsuario) on update cascade on delete cascade,
    FOREIGN KEY (idKarte) REFERENCES karte(idKarte) on update cascade on delete cascade
);



/*PROCEDIMIENTOS ALMACENADOS*/

drop procedure if exists logIn;
delimiter **
create procedure logIn(in mail varchar(60), in psw varchar(32))
begin
	declare admOusr int;
    declare ok int;
    declare msj varchar(60);
    set admOusr = (select count(idAdmin) from admini where email = mail);
		if(admOusr != 0)then
			set ok = (select count(idAdmin) from admini where email = mail and contra = psw);
				if(ok = 0)then
					set msj = 'ADMIN NO ENCONTRADO';
                    select msj as aviso;
                else
					select * from admini;
                end if;
        else
			set ok = (select count(idUsuario) from usuario where email = mail and contra = psw);
            if(ok = 0)then
					set msj = 'USUARIO NO ENCONTRADO';
                    select msj as aviso;
                else
					select * from usuario;
                end if;
        end if;      
        
end**
delimiter ;
select * from usuario;
call logIn('isaac@mail.com','1234');

drop procedure if exists agregarUsuario;
delimiter **
CREATE PROCEDURE agregarUsuario(in nombreU varchar(100), in apellidoU varchar(100), in gener varchar(15), in psw varchar(32), in mail varchar(60), in age int(2))
begin
	DECLARE msj VARCHAR(60);
    DECLARE idUsuAux int(10);
    DECLARE existe int;
    set existe = (select count(idUsuario) from usuario where email = mail);
    if(existe = 0) then
		IF(nombreU != '')THEN
			IF(apellidoU != '') then
				IF(gener != '' ) then
					IF(psw != '' ) then
						IF(mail != '') then
							insert into usuario(nombreUsuario,apellidoUsuario,genero,contra,email,edad) values(nombreU, apellidoU, gener, psw, mail, age);                      
							set msj = 'Usuario agregado';
						ELSE
							set msj = 'EL PASSWORD ESTA VACIO';
						END IF;
					ELSE
						set msj = 'EL PASSWORD ESTA VACIO';
					END IF;
				ELSE
					set msj = 'EL GENERO ESTA VACIO';
				END IF;
			else
				set msj = 'EL APELLIDO ESTA VACIO';
			end if;
		ELSE	
			set msj = 'EL NOMBRE ESTA VACIO';
		END IF;
	else	
		set msj = 'Ese correo ya esta ocupado';
	END IF;
    select msj as aviso;
end**
delimiter ;
call agregarUsuario('ISAAC','MARTINEZ SANCHEZ', 'MASCULINO', '1234','isaac@mail.com',20);
select * from usuario;
drop procedure if exists agregarAdmin;
delimiter **
create procedure agregarAdmin(in mail varchar(60), in psw varchar(32))
begin
	declare existe int;
    declare msj varchar(50);
    set existe = (select count(idAdmin) from admini where email = mail);
    if(existe = 0)then
		if(mail != '')then
			if(psw != '') then
				insert into admini(contra,email)values(psw, mail);
				set msj = 'Administrador agregado';
            else
				set msj = 'CONTRASENA VACIA';
            end if;
        else
			set msj = 'EL MAIL ESTA VACIO';
        end if;			
    else
		set msj = 'Ese correo de administrador ya esta ocupado';
	end if;
    select msj as aviso;
end **
delimiter ;

select * from admini;
call agregarAdmin('admin1@admin.com','1324');
call logIn('admin@admin.com','134');

/*Recuperar datos del usuario*/
drop procedure if exists datosUsuario;
delimiter **
create procedure datosUsuario(in mail varchar(60))
begin
	declare existe int;
    declare msj varchar(60);
    set existe = (select count(idUsuario) from usuario where email = mail);
    if(existe != 0)then
		select idUsuario, nombreUsuario as 'Nombre', apellidoUsuario as 'Apellidos', genero as 'Genero', email as 'E-mail', edad as 'Edad', fotoPerfil as 'Foto de Perfil' from usuario where email = mail;        
    else
		set msj = 'Ese usuario no existe';        
        select msj as aviso;
end if;		
end**
delimiter ;
select * from usuario;
call datosUsuario('isi_mrt@hotmail.com');


drop procedure if exists actualizarDatos;
delimiter **
create procedure actualizarDatos(in newnombreUsuario varchar(100),in newapellidoUsuario varchar(100),in newgenero varchar(15), in mail varchar(60),in newemail varchar(60), in newedad int(2) ,in newfotoPerfil varchar(500) )	
begin
	declare existe int;
    declare msj varchar(100);
    declare idaux int(10);
    set existe = (select count(idUsuario) from usuario where mail = email);
    if(existe != 0)then
		set idaux = (select idUsuario from usuario where mail = email);
		if(newemail = '')then /*No se cambiara la sesion de la pagina*/
			if(newnombreUsuario != '') then
				if(newapellidoUsuario != '') then
					if(newgenero != '')then
						if(newedad > 15 AND newedad < 100)then
							if(newfotoPerfil != '') then
								update usuario set nombreUsuario = newnombreUsuario, apellidoUsuario = newapellidoUsuario, genero = newgenero, edad = newedad, fotoPerfil = concat('./../imgs/users/', newfotoPerfil) where idUsuario = idaux;
                                set msj = '¡Datos del usuario modificados correctamente!';
							else
								update usuario set nombreUsuario = newnombreUsuario, apellidoUsuario = newapellidoUsuario, genero = newgenero, edad = newedad where idUsuario = idaux;
                                set msj = '¡Datos del usuario modificados correctamente!';
                            end if;
                        else
							set msj = 'Edad fuera del rango';
                        end if;							
                    else	
						set msj = 'Se debe elegir un genero';
                    end if;
                else
					set msj = 'Los apellidos no pueden estar vacios';
                end if;
            else
				set msj = 'El nombre no puede estar vacio';
            end if;            
        else	/*Se cambiara la sesion de la pagina*/				
			if(newnombreUsuario != '') then
				if(newapellidoUsuario != '') then
					if(newgenero != '')then
						if(newedad > 15 AND newedad < 100)then
							if(newfotoPerfil != '') then
								update usuario set nombreUsuario = newnombreUsuario, apellidoUsuario = newapellidoUsuario, genero = newgenero, email=newemail, edad = newedad, fotoPerfil = concat('./../imgs/users/', newfotoPerfil) where idUsuario = idaux;
                                set msj = '¡Datos del usuario modificados correctamente!';
							else
								update usuario set nombreUsuario = newnombreUsuario, apellidoUsuario = newapellidoUsuario, genero = newgenero, email=newemail, edad = newedad where idUsuario = idaux;
                                set msj = '¡Datos del usuario modificados correctamente!';
                            end if;
                        else
							set msj = 'Edad fuera del rango';
                        end if;							
                    else	
						set msj = 'Se debe elegir un genero';
                    end if;
                else
					set msj = 'Los apellidos no pueden estar vacios';
                end if;
            else
				set msj = 'El nombre no puede estar vacio';
            end if;   
        end if;
    else
		set msj = 'Ese usuario no existe';
    end if;
    select msj as aviso;
end**
delimiter ;
select * from usuario;
call actualizarDatos('Isaac','Martinez Sanchez','Masculino', 'isi_mrt@hotmail.com','', 21, 'user4.jpg');	


drop view if exists explorarCategorias;
create view explorarCategorias as	
    select nombreCategoria as 'Categorias', imagen from categorias ORDER BY RAND() limit 7;

drop view if exists explorarPapeles;
create view explorarPapeles as	    
    select nombrePapel as 'Papeles', img  from papel ORDER BY RAND() limit 7;



/*INSERTS NECESARIOS PARA LOS PAPELES Y CATEGORIAS*/
	insert into papel (nombrePapel, img) values ('Papel1','./../imgs/papeles/papel1.jpg'),
										   ('Papel2','./../imgs/papeles/papel2.jpg'),
                                           ('Papel3','./../imgs/papeles/papel3.jpg'),
                                           ('Papel4','./../imgs/papeles/papel4.jpg'),
                                           ('Papel5','./../imgs/papeles/papel5.jpg'),
                                           ('Papel6','./../imgs/papeles/papel6.jpg'),
                                           ('Papel7','./../imgs/papeles/papel7.jpg'),
                                           ('Papel8','./../imgs/papeles/papel8.jpg'),
                                           ('Papel9','./../imgs/papeles/papel9.jpg'),
                                           ('Papel10','./../imgs/papeles/papel10.jpg');
                                           
delete from papel where idPapel > 10;                                    
insert into categorias(nombreCategoria, imagen, conteo) values ('Amor', './../imgs/categorias/categoria1.jpg',0),                                           
															   ('Amistad', './../imgs/categorias/categoria2.jpg',0),
                                                               ('Invierno', './../imgs/categorias/categoria3.jpg',0),
                                                               ('Navidad', './../imgs/categorias/categoria4.jpg',0),
                                                               ('Sanación', './../imgs/categorias/categoria5.jpg',0),
                                                               ('Cumpleaños', './../imgs/categorias/categoria6.jpg',0),
                                                               ('Ciudades', './../imgs/categorias/categoria7.jpg',0),
                                                               ('Paisajes', './../imgs/categorias/categoria8.jpg',0),
                                                               ('Graduación', './../imgs/categorias/categoria9.jpg',0),
                                                               ('Lugares', './../imgs/categorias/categoria10.jpg',0);
    
select * from explorarCategorias;
select * from explorarPapeles;

drop procedure if exists cambiarPSW;
delimiter **
create procedure cambiarPSW(in mailU varchar(60), in npsw varchar(32), in npswv nvarchar(32))
begin
	declare existe int;
    declare msj varchar(100);
    declare aux int(10);
    set existe = (select count(idUsuario) from usuario where email = mailU);
    if(existe != 0)then
		if(npsw != '' )then
			if(npswv != '')then
				if(npsw = npswv) then
					set aux = (select idUsuario from usuario where email = mailU);
					update usuario set contra = npsw where idUsuario = aux;
                    set msj = 'Datos modificados';
				else
					set msj = 'Las contraseñas no son iguales';
				end if;
            else
				set msj = 'Campo contrasena nueva verificacion VACIO';
            end if;
        else
			set msj = 'Campo contrasena nueva VACIO';
        end if;
    else
		set msj = 'Usario inexistente';
    end if;  
    select msj as aviso;
end**
delimiter ;

select * from usuario;

call cambiarPSW('isi_mrt@hotmail.com','123456','123456');










