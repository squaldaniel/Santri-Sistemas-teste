-- ALTERAÇÕES NO BANNCO DE DAADOS
delimiter //
	create procedure loginuser (arg_login varchar(30), arg_senha varchar(30))
	begin
		select count(*) as permitido  from usuarios where login=arg_login and senha=arg_senha and ativo="S";
	end //
delimiter ;

delimiter //
	create procedure sp_upusuario(arg_usuarioid int, arg_login varchar(30), arg_senha varchar(30), arg_ativo varchar(1), arg_nomecompleto varchar(50))
	begin
		update usuarios set login=arg_login , SENHA=arg_senha, ATIVO=arg_ativo, NOME_COMPLETO=arg_nomecompleto 
			where USUARIO_ID=arg_usuarioid;
	end //
delimiter ;

delimiter //
	create procedure sp_addusuario(arg_nomecompleto varchar(50), arg_login varchar(30), arg_senha varchar(30))
	begin
		insert into usuarios(NOME_COMPLETO, LOGIN, SENHA) values (arg_nomecompleto, arg_login, arg_senha);
	end //
delimiter ;

delimiter //
	create procedure sp_addpermission(arg_userid int, keypermission varchar(100))
	begin
		insert into autorizacoes () values ();
	end //
delimiter ;
