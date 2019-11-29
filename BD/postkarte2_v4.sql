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

drop table if exists papelcategoria;
create table papelcategoria
(
	idPC int(10) not null primary key auto_increment,
    idPapel int(10) not null,
    idCategoria int(10) not null,
    foreign key (idPapel) references papel(idPapel) on update cascade on delete cascade,
    foreign key (idCategoria) references categorias(idCategoria) on update cascade on delete cascade
);

drop table if exists karte;
create table karte
(
	idKarte int(3) primary key not null auto_increment,
    nombreK nvarchar(200) not null,
    descripcion nvarchar(200) not null,
    idPapel int(3) not null,
    enviados int(4) not null default 0,
	rutaK varchar(150) NOT NULL DEFAULT './../imgs/papeles/papel1.jpg',
    estatus char(1) not null default 'P' /*P = Pendiente, V = Vista*/,
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
    fechaEnvio datetime default current_timestamp,
    FOREIGN KEY (idRemitente) REFERENCES usuario(idUsuario) on update cascade on delete cascade,
    FOREIGN KEY (idDestinatario) REFERENCES usuario(idUsuario) on update cascade on delete cascade,
    FOREIGN KEY (idKarte) REFERENCES karte(idKarte) on delete cascade
);



/*PROCEDIMIENTOS ALMACENADOS*/

drop procedure if exists logIn;
delimiter **
create procedure logIn(in mail varchar(60), in psw varchar(32))
begin
	declare admOusr int;
    declare ok int;
    declare msj varchar(60);
    declare aux int;
    set admOusr = (select count(idAdmin) from admini where email = mail);
		if(admOusr != 0)then
			set ok = (select count(idAdmin) from admini where email = mail and contra = psw);
				if(ok = 0)then
					set msj = 'ADMIN NO ENCONTRADO';
                    select msj as aviso;
                else
					set aux = (select idAdmin from admini where  email = mail and contra = psw);
					select * from admini where idAdmin = aux;
                end if;
        else
			set ok = (select count(idUsuario) from usuario where email = mail and contra = psw);
            if(ok = 0)then
					set msj = 'USUARIO NO ENCONTRADO';
                    select msj as aviso;
                else
					set aux = (select idUsuario from usuario where email = mail and contra = psw);
					select * from usuario where idUsuario = aux;
                end if;
        end if;

end**
delimiter ;
select * from usuario;
call logIn('isaack@mail.com','1234');

drop procedure if exists agregarUsuario;
delimiter **
CREATE PROCEDURE agregarUsuario(in nombreU varchar(100), in apellidoU varchar(100), in gener varchar(15), in psw varchar(32), in mail varchar(60), in age int(2),in fotoP varchar(500))
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
							IF(fotoP != '') then
								insert into usuario(nombreUsuario,apellidoUsuario,genero,contra,email,edad,fotoPerfil) values(nombreU, apellidoU, gener, psw, mail, age, concat("./../imgs/users/",fotoP));
								set msj = 'Usuario agregado';
							else
								insert into usuario(nombreUsuario,apellidoUsuario,genero,contra,email,edad) values(nombreU, apellidoU, gener, psw, mail, age);
								set msj = 'Usuario agregado';
                            end if;
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
call agregarUsuario('ISAACK','MARTINEZ SANCHEZ', 'MASCULINO', '1234','isaack@mail.com',20,'');
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
    select nombreCategoria as 'Categorias', imagen from categorias ORDER BY RAND() limit 10;

drop view if exists explorarPapeles;
create view explorarPapeles as
    select nombrePapel as 'Papeles', img  from papel ORDER BY RAND() limit 20;
    
select * from explorarPapeles;
/*INSERTS NECESARIOS PARA LOS PAPELES Y CATEGORIAS*/

insert into categorias(nombreCategoria, imagen, conteo) values ('Amor', './../imgs/categorias/categoria1.jpg',0),
															   ('Amistad', './../imgs/categorias/categoria2.jpg',0),
                                                               ('Invierno', './../imgs/categorias/categoria3.jpg',0),
                                                               ('Navidad', './../imgs/categorias/categoria4.jpg',0),
                                                               ('Sanación', './../imgs/categorias/categoria5.jpg',0),
                                                               ('Cumpleaños', './../imgs/categorias/categoria6.jpg',0),
                                                               ('Ciudades', './../imgs/categorias/categoria7.jpg',0),
                                                               ('Paisajes', './../imgs/categorias/categoria8.jpg',0),
                                                               ('Graduación', './../imgs/categorias/categoria9.jpg',0),
                                                               ('Lugares', './../imgs/categorias/categoria10.jpg',0),
                                                               ('Otro', './../imgs/categorias/categoria11.jpg',0);

insert into papel (nombrePapel, img)
									values ('Papel1','./../imgs/papeles/papel1.jpg'),
										   ('Papel2','./../imgs/papeles/papel2.jpg'),
                                           ('Papel3','./../imgs/papeles/papel3.jpg'),
                                           ('Papel4','./../imgs/papeles/papel4.jpg'),
                                           ('Papel5','./../imgs/papeles/papel5.jpg'),
                                           ('Papel6','./../imgs/papeles/papel6.jpg'),
                                           ('Papel7','./../imgs/papeles/papel7.jpg'),
                                           ('Papel8','./../imgs/papeles/papel8.jpg'),
                                           ('Papel9','./../imgs/papeles/papel9.jpg'),
                                           ('Papel10','./../imgs/papeles/papel10.jpg'),
                                           ('amor1','./../imgs/papeles/amor1.jpg'), ('amor2','./../imgs/papeles/amor2.jpg'),('amor3','./../imgs/papeles/amor3.jpg'), ('amor6','./../imgs/papeles/amor6.jpg'),('amor4','./../imgs/papeles/amor4.jpg'), ('amor5','./../imgs/papeles/amor5.jpg'),
                                           ('birthday1','./../imgs/papeles/birthday1.jpg'), ('birthday2','./../imgs/papeles/birthday2.jpg'),('birthday3','./../imgs/papeles/birthday3.jpg'), ('birthday4','./../imgs/papeles/birthday4.jpg'),('birthday5','./../imgs/papeles/birthday5.jpg'), ('birthday6','./../imgs/papeles/birthday6.jpg'),('birthday7','./../imgs/papeles/birthday7.jpg'),
                                           ('christmas1','./../imgs/papeles/christmas1.jpg'), ('christmas2','./../imgs/papeles/christmas2.png'),('christmas3','./../imgs/papeles/christmas3.jpg'), ('christmas4','./../imgs/papeles/christmas4.jpg'), ('christmas5','./../imgs/papeles/christmas5.jpg'),('christmas6','./../imgs/papeles/christmas6.jpg'),('christmas7','./../imgs/papeles/christmas7.jpg'),
                                           ('city1','./../imgs/papeles/city1.jpg'), ('city2','./../imgs/papeles/city2.jpg'),('city3','./../imgs/papeles/city3.jpg'), ('city4','./../imgs/papeles/city4.jpg'),('city5','./../imgs/papeles/city5.jpg'), ('city6','./../imgs/papeles/city6.jpg'),('city7','./../imgs/papeles/city7.jpg'),('city8','./../imgs/papeles/city8.jpg'),
                                           ('friendship1','./../imgs/papeles/friendship1.jpg'), ('friendship2','./../imgs/papeles/friendship2.jpg'),('friendship3','./../imgs/papeles/friendship3.jpg'), ('friendship4','./../imgs/papeles/friendship4.jpg'),('friendship5','./../imgs/papeles/friendship5.jpg'), ('friendship6','./../imgs/papeles/friendship6.jpg'),                                           
                                           ('graduation1','./../imgs/papeles/graduation1.jpg'), ('graduation2','./../imgs/papeles/graduation2.jpg'),('graduation3','./../imgs/papeles/graduation3.jpg'), ('graduation4','./../imgs/papeles/graduation4.jpg'),('graduation5','./../imgs/papeles/graduation5.jpg'), ('graduation6','./../imgs/papeles/graduation6.jpg'),('graduation7','./../imgs/papeles/graduation7.jpg'),('graduation8','./../imgs/papeles/graduation8.jpg'),
                                           ('heal1','./../imgs/papeles/heal1.jpg'), ('heal2','./../imgs/papeles/heal2.jpg'),('heal3','./../imgs/papeles/heal3.jpg'), ('heal4','./../imgs/papeles/heal4.jpg'),('heal5','./../imgs/papeles/heal5.jpg'), ('heal6','./../imgs/papeles/heal6.jpg'),          
                                           ('landscape1','./../imgs/papeles/landscape1.jpg'), ('landscape2','./../imgs/papeles/landscape2.jpg'),('landscape3','./../imgs/papeles/landscape3.jpg'), ('landscape4','./../imgs/papeles/landscape4.jpg'),('landscape5','./../imgs/papeles/landscape5.png'),
                                           ('place1','./../imgs/papeles/place1.jpg'), ('place2','./../imgs/papeles/place2.jpg'),('place3','./../imgs/papeles/place3.jpg'), ('place4','./../imgs/papeles/place4.jpg'),('place5','./../imgs/papeles/place5.jpg'), ('place6','./../imgs/papeles/place6.jpg'),('place7','./../imgs/papeles/place7.jpg'),('place8','./../imgs/papeles/place8.jpg'),
                                           ('winter1','./../imgs/papeles/winter1.jpg'), ('winter2','./../imgs/papeles/winter2.jpg'),('winter3','./../imgs/papeles/winter3.jpg'), ('winter4','./../imgs/papeles/winter4.jpg'),('winter5','./../imgs/papeles/winter5.jpg'), ('winter6','./../imgs/papeles/winter6.jpg');         

insert into papelcategoria (idPapel,idCategoria) values(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1);

insert into papelcategoria (idPapel, idCategoria) values (11, 1),(12, 1),(13, 1),(14, 1),(15, 1),(16, 1); /*IMAGENES / PAPELES --> AMOR*/
insert into papelcategoria (idPapel, idCategoria) values (17, 6),(18, 6),(19, 6),(20, 6),(21, 6),(22, 6),(23,6); /*IMAGENES / PAPELES --> BIRTHDAY*/
insert into papelcategoria (idPapel, idCategoria) values (24, 4),(25, 4),(26, 4),(27, 4),(28, 4),(29, 4),(30,4); /*IMAGENES / PAPELES --> NAVIDAD*/
insert into papelcategoria (idPapel, idCategoria) values (31, 7),(32, 7),(33, 7),(34, 7),(35, 7),(36, 7),(37,7),(38,7); /*IMAGENES / PAPELES --> Ciudades*/
insert into papelcategoria (idPapel, idCategoria) values (39, 2),(40, 2),(41, 2),(42, 2),(43, 2),(44, 2); /*IMAGENES / PAPELES --> AMISTA*/
insert into papelcategoria (idPapel, idCategoria) values (45, 9),(46, 9),(47, 9),(48, 9),(49, 9),(50, 9),(51,9),(52,9); /*IMAGENES / PAPELES --> GRADUACION*/
insert into papelcategoria (idPapel, idCategoria) values (53, 5),(54, 5),(55, 5),(56, 5),(57, 5),(58, 5); /*IMAGENES / PAPELES --> heal*/
insert into papelcategoria (idPapel, idCategoria) values (59, 8),(60, 8),(61, 8),(62, 8),(63, 8); /*IMAGENES / PAPELES --> PAISAJES*/
insert into papelcategoria (idPapel, idCategoria) values (64, 10),(65, 10),(66, 10),(67, 10),(68, 10),(69, 10),(70,10),(71,10); /*IMAGENES / PAPELES --> LUGARES*/
insert into papelcategoria (idPapel, idCategoria) values (72, 3),(73, 3),(74, 3),(75, 3),(76, 3),(77,3); /*IMAGENES / PAPELES --> INVIERNO*/
select * from papelcategoria;
select * from papel;
select * from categorias;
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
select * from categorias;
delete from usuario where idUsuario > 1;
call cambiarPSW('isi_mrt@hotmail.com','123456','123456');
call logIn('isi_mrt@hotmail.com','1234');
call datosUsuario('isi_mrt@hotmail.com');
call agregarUsuario('ISAAC','MARTINEZ SANCHEZ', 'MASCULINO', '1234','isi_mrt@hotmail.com',20,'');

select * from papel;
drop procedure if exists obtenerCategoriasTitulo;
delimiter **
create procedure obtenerCategoriasTitulo(in nombreCat varchar(100))    
begin	
	declare idcataux int;
	set idcataux = (select idCategoria from categorias where nombreCategoria = nombreCat);
    select papel.img as 'Imagen', papel.nombrePapel as 'Nombre' from papel, papelcategoria where papelcategoria.idCategoria = idcataux and papel.idPapel = papelcategoria.idPapel;
end**
delimiter ;

call obtenerCategoriasTitulo('Amor');


drop procedure if exists selectEmail;
delimiter **
create procedure selectEmail(in mail varchar(60))
begin
	declare existe int;
    declare msj varchar(60);
    
    set existe = (select count(idUsuario) from usuario where email = mail );
    if(existe != 0) then
		select email from usuario where email = mail;
    else
		set msj = 'Ese usuario no existe';
        select msj as aviso;
    end if;
end **
delimiter ;
select * from usuario;
call selectEmail('isi_mrt@hotmail.com');


drop procedure if exists postalEnviada;
delimiter **
create procedure postalEnviada(in nombreKarte varchar(50), in emailE varchar(60), in emailR varchar(60))
begin 	
    declare idkarteaux int;
    declare idremitente int;
    declare iddestina int;    
    declare msj varchar(60);
    declare existeu int;
    declare existed int;
    set existeu = (select count(idUsuario) from usuario where email = emailE);
    set existed = (select count(idUsuario) from usuario where email = emailR);
    if(existeu != 0)then
			if(existed != 0) then
				    set idKarteaux = (select idKarte from karte where nombreK = nombreKarte limit 1);
					set idremitente = (select idUsuario from usuario where email = emailE limit 1);
					set iddestina = (select idUsuario from usuario where email = emailR limit 1);  
                    insert into postales.relusuariokarte(idRemitente, idDestinatario, idKarte) values (idremitente,iddestina,idKarteaux);    
					set msj = 'OK';   
                    select msj as aviso;
            else
				set msj = 'Destinatario inexistente';
                select msj as aviso;
			end if;
    end if;    
end**
delimiter ;

drop procedure if exists agregarPostalEnviada;
delimiter **
create procedure agregarPostalEnviada(in nombreKarte varchar(200), in descrip varchar(120) , statuss char(1), in nombrepapel varchar(150), in emailE varchar(60), in emailR varchar(60))
begin
	declare existe int;
    declare idauxpapel int;
    declare msj varchar(60);
    declare rutaaux varchar(150);
    set existe = (select count(idKarte) from karte where nombreK = nombreKarte);
    if( nombreKarte != '' )then
		if( descrip != '')then		
				if(statuss != '') then
					if( nombrepapel != '' and emailR != '')then			
						if(existe = 0) then
							set idauxpapel = (select postales.papel.idPapel from papel where postales.papel.nombrePapel = nombrepapel limit 1);
							set rutaaux = (select img from postales.papel where postales.papel.nombrePapel = nombrepapel and postales.papel.idPapel = idauxpapel limit 1);
							insert into postales.karte set postales.karte.nombreK = nombreKarte, postales.karte.descripcion = descrip, postales.karte.rutaK = rutaaux, postales.karte.estatus = statuss,postales.karte.enviados = postales.karte.enviados + 1, postales.karte.idPapel = idauxpapel;
							call postalEnviada(nombreKarte, emailE, emailR);	
						else 
							set msj = 'Nombre de postal repetida';
                            select msj as aviso;
						end if;
                    else
						set msj = 'Nombre del papel vacio';
                        select msj as aviso;
                    end if;
                else
					set msj = 'Estatus vacio';
					select msj as aviso;
                end if;						
        else
			set msj = 'Descripcion nula';
			select msj as aviso;
        end if;
    else
		set msj = 'Nombre de la postal vacio';
        select msj as aviso;
    end if;        
end**
delimiter ;
select * from relusuariokarte;
drop procedure if exists obtenerPostalesRecibidas;
delimiter **
create procedure obtenerPostalesRecibidas(in correo varchar(60))
begin
	declare existe int;
    declare idpostaux int;
    declare idusuarioaux int;    
    declare msj varchar(60);
    set idusuarioaux = (select idUsuario from usuario where email = correo); 
    if(idusuarioaux != 0) then
		select postales.karte.nombreK as 'Nombre', postales.karte.descripcion as 'Descripcion', postales.karte.rutaK as 'Imagen', postales.karte.estatus as 'Estatus' from postales.karte, postales.relusuariokarte where postales.relusuariokarte.idDestinatario = idusuarioaux and postales.relusuariokarte.idKarte = postales.karte.idKarte;
	else
		select postales.karte.nombreK as 'Nombre', postales.karte.descripcion as 'Descripcion', postales.karte.rutaK as 'Imagen', postales.karte.estatus as 'Estatus' from postales.karte, postales.relusuariokarte where postales.relusuariokarte.idDestinatario = idusuarioaux and postales.relusuariokarte.idKarte = postales.karte.idKarte;
    end if;
end**
delimiter ;
select * from usuario;
call obtenerPostalesRecibidas('isaac31120@gmail.com');

drop procedure if exists obtenerPostalesEnviadas;
delimiter **
create procedure obtenerPostalesEnviadas(in correo varchar(60))
begin
	declare existe int;
    declare idpostaux int;
    declare idusuarioaux int;    
    declare msj varchar(60);
    set idusuarioaux = (select idUsuario from usuario where email = correo); 
    if(idusuarioaux != 0) then
		select postales.karte.nombreK as 'Nombre', postales.karte.descripcion as 'Descripcion', postales.karte.rutaK as 'Imagen', postales.karte.estatus as 'Estatus' from postales.karte, postales.relusuariokarte where postales.relusuariokarte.idRemitente = idusuarioaux and postales.relusuariokarte.idKarte = postales.karte.idKarte;
	else
		select postales.karte.nombreK as 'Nombre', postales.karte.descripcion as 'Descripcion', postales.karte.rutaK as 'Imagen', postales.karte.estatus as 'Estatus' from postales.karte, postales.relusuariokarte where postales.relusuariokarte.idRemitente = idusuarioaux and postales.relusuariokarte.idKarte = postales.karte.idKarte;
    end if;
end**
delimiter ;

call obtenerPostalesEnviadas('isaac31120@gmail.co');

call agregarUsuario('Sara','MARTINEZ SANCHEZ', 'Femenino', '1234','saramtzbu@gmail.com',16,'');
call datosUsuario('isaac31120@gmail.com');
select * from karte;

drop procedure if exists cambiarEstadoPK;
delimiter **
create procedure cambiarEstadoPK(in nombre varchar(200))
begin
	declare existe int;
    declare msj varchar(60);
    declare idpkaux int;
    declare statprev char(1);
    set existe = (select count(idKarte) from karte where nombreK = nombre);
    if(existe != 0)then
		set idpkaux = (select idKarte from karte where nombreK = nombre);
        set statprev = (select estatus from karte where idKarte = idpkaux);
        if(statprev = 'V')then
			set msj = 'Ya la vio';
		else 
			update karte set estatus = 'V' where idKarte = idpkaux;
            set msj = 'Estatus actualizado';
        end if;
    else
		set msj = 'Ese nombre de la postal no existe';
    end if;
    select msj as aviso;
end **
delimiter ;
call cambiarEstadoPK('Graduacion');
select * from usuario;
select * from categorias;
select papel.img as 'imagen' from papel, categorias, papelcategoria where papel.idPapel = papelcategoria.idPapel and categorias.idCategoria = papelcategoria.idCategoria and categorias.nombreCategoria = 'Amor';
select * from papelcategoria;
select * from karte where nombreK = 'Estudia';
delete from karte where idKarte > 1;
delete from relusuariokarte where idEnviados >= 1;

select * from karte where nombreK = 'WinterPostal';
select * from admini;
select * from usuario;
call postales.logIn('admin1@admin.com','1324');
call postales.logIn('isaac31120@gmail.com','1234'); 
select * from usuario;
delete from usuario where idUsuario = 4;