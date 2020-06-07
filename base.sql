drop database if exists inventarios;
create database inventarios;

use inventarios;

drop table if exists tUsuarios;
create table tUsuarios(
	idUsr  int(5) primary key,
    tipoUsr int(3),
    nombre varchar(20),
    psw varchar(20)
);


drop table if exists tProductos;
create table tProductos(
	idProducto int(5) primary key,
    nombre varchar(100),
    cantidad int(5),
    precio int(5),
    fecha date,
    categ varchar(100),
    idUsr int(5),
    foreign key (idUsr) references tUsuarios(idUsr) ON DELETE CASCADE
);

drop table if exists tVentas;
create table tVentas(
	idVenta int(5) primary key,
    monto int(10),
    cantidad int(10),
    fecha date,
    idProducto int(5),
    foreign key (idProducto) references tProductos(idProducto) ON DELETE CASCADE
);

drop procedure if exists venta;
delimiter **
create procedure venta(xidProducto int(5), xcant int(10))
begin 
declare msj varchar(50);
declare xfecha date;
declare xidVenta int;
declare xdispo int;
declare xmonto int;
	set xdispo =(select cantidad from tProductos where idProducto = xidProducto);
	if(xdispo < xcant) then 
		set msj = "nose puede";
	else
    
    set xdispo = xdispo -xcant;
    set xmonto =(select precio from tProductos where idProducto = xidProducto);
	set xfecha = curdate();
	set xidVenta = (select ifnull(max(idVenta),0) from tVentas)+1;
    update tProductos set cantidad = xdispo where idProducto = xidProducto; 
    set xmonto = xmonto * xcant;
    insert into tVentas(idVenta, monto, cantidad, fecha, idProducto )
	values(xidVenta, xmonto, xcant, xfecha,  xidProducto);
	set msj = "muajaja";
	end if;
select msj as Resultado;
end; **
delimiter ;
call venta('2', "2");



drop procedure if exists consulVentas;
delimiter **
create procedure consulVentas(xidUsr int(5))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tVentas );
	if(existencia = 0)then 
		set msj = "No hay ventas";
	end if;
    select sum(monto), sum(tVentas.cantidad), tVentas.idProducto from tVentas inner join tProductos on tVentas.idProducto  = tProductos.idProducto where idUsr = xidUsr ;
    end; **
delimiter ;
call consulVentas(2);
 
 
drop procedure if exists consulVentasMen;
delimiter **
create procedure consulVentasMen(xidUsr int(5))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tVentas WHERE fecha = MONTH(CURDATE()) );
	if(existencia = 0)then 
		set msj = "No hay ventas";
	end if;
    select count(tVentas.idProducto) from tVentas inner join tProductos on tVentas.idProducto  = tProductos.idProducto where idUsr = xidUsr and month(tVentas.fecha) = MONTH(CURDATE());
    end; **
delimiter ;
call consulVentasMen(2); 

drop procedure if exists AProdcutos;
delimiter **
create procedure AProdcutos(xnom varchar(100), xcant varchar(20), xprecio int(5), xfecha date, xcat varchar(100), xidUsr int(5))
begin 
declare msj varchar(50);
declare existencia int;
declare xidProducto int;
	set existencia = (select count(*) from tProductos where nombre = xnom and idUsr = xidUsr);
    if(xnom = null) THEN
		set msj = "nosta";
    end if;
    if( existencia = 0) then
		set xidProducto = (select ifnull(max(idProducto),0) from tProductos)+1;
		insert into tProductos(idProducto, nombre, cantidad, precio, fecha, categ, idUsr )
        values(xidProducto, xnom, xcant, xprecio, xfecha, xcat, xidUsr );
        set msj = "Agregado";
	else	
		set msj = "Error en la matrix";
    end if;
select msj as Resultado;
end; **
delimiter ;
call AProdcutos("carne", 2, 50, "2019-05-06", "carne", "2");

drop procedure if exists consultaProd;
delimiter **
create procedure consultaProd(xidUsr int(5))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tProductos where idUsr = xidUsr );
	if(existencia = 0)then 
		set msj = "No hay productos";
	end if;
    select nombre, cantidad, precio, fecha, categ from tProductos where idUsr = xidUsr;
end; **
delimiter ;
call consultaProd("2");

drop procedure if exists buscaProd;
delimiter **
create procedure buscaProd(in xidUsr int(5), in xnom varchar(50))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tProductos where nombre = xnom and  idUsr = xidUsr );
	if(existencia = 0)then 
		set msj = "No hay producto";
	end if;
    select nombre, cantidad, precio, fecha, categ, idProducto from tProductos where nombre = xnom and  idUsr = xidUsr ;
end; **
delimiter ;
call buscaProd('2', "celular");

drop procedure if exists borraProd;
delimiter **
create procedure borraProd(in xidUsr int(5), in xnom varchar(50) )
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tProductos where nombre = xnom and idUsr = xidUsr);
	if(existencia = 0)then 
		set msj = "No hay producto";
	end if;
    delete from tProductos where nombre = xnom and idUsr = xidUsr;
end; **
delimiter ;
call borraProd('2', "celular");
 delete from tProductos where nombre = "bateria" and idUsr = 2;


drop procedure if exists actProd;
delimiter **
create procedure actProd(xnom varchar(100), xcant varchar(20), xprecio int(5), xfecha date, xcat varchar(100), xidUsr int(5)) 
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tProductos where nombre = xnom and idUsr = xidUsr);
	if(existencia = 0)then 
		set msj = "No hay usuario";
	else
		update tProductos set nombre = xnom, cantidad = xcant,  precio = xprecio, fecha = xfecha, categ = xcat where nombre = xnom and idUsr = xidUsr; 
        set msj = "grrrr";
	end if;
    select msj as Resultado;
end; **
delimiter ;
call actProd("carne", 2, 50, "2019-05-06", "carne", "2");

select * from tProductos;

drop procedure if exists iniciarSes;
delimiter **
create procedure iniciarSes(in xusr varchar(50),in xpsw varchar(50))
begin
declare msj varchar(50);
declare existencia int;
    set existencia = (select count(*) from tUsuarios where nombre = xusr and psw = xpsw);
    if( existencia = 0 )then
        set msj = "NO INICIAR";
	else	
		set msj = "SI INICIAR";
    end if;
select msj as Resultado, tipoUsr from tUsuarios where nombre = xusr and psw = xpsw;
end; **
delimiter ;
call iniciarSes('Ted', '271');

drop procedure if exists AUsuarios;
delimiter **
create procedure AUsuarios(xtipo INT(5), xnom varchar(20), xpsw varchar(20))
begin 
declare msj varchar(50);
declare existencia int;
declare xidUsr int;
	set existencia = (select count(*) from tUsuarios where nombre = xnom);
    if(xnom = null) THEN
		set msj = "nosta";
    end if;
    if( existencia = 0) then
		set xidUsr = (select ifnull(max(idUsr),0) from tUsuarios)+1;
		insert into tUsuarios(idUsr, tipoUsr, nombre, psw)
        values(xidUsr, xtipo, xnom, xpsw);
        set msj = "Agregado";
	else	
		set msj = "Error en la matrix";
    end if;
select msj as Resultado;
end; **
delimiter ;
call AUsuarios(1, "Ted", "2712");

drop procedure if exists consultaUsr;
delimiter **
create procedure consultaUsr()
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tUsuarios );
	if(existencia = 0)then 
		set msj = "No hay usuario";
	end if;
    select nombre, tipoUsr, md5(psw),idUsr from tUsuarios;
end; **
delimiter ;
call consultaUsr();


drop procedure if exists buscaUsr;
delimiter **
create procedure buscaUsr(in xusr varchar(50))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tUsuarios where nombre = xusr);
	if(existencia = 0)then 
		set msj = "No hay usuario";
	end if;
    select nombre, tipoUsr, md5(psw),idUsr from tUsuarios where nombre = xusr;
end; **
delimiter ;
call buscaUsr('valeria');

drop procedure if exists borraUsr;
delimiter **
create procedure borraUsr(in xusr varchar(50))
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tUsuarios where nombre = xusr);
	if(existencia = 0)then 
		set msj = "No hay usuario";
	end if;
    delete from tUsuarios where nombre = xusr;
end; **
delimiter ;
call borraUsr('valeria');

drop procedure if exists actUsr;
delimiter **
create procedure actUsr(in xusr varchar(50), in xpsw varchar(50), in xtipo int, in xnpsw varchar(50)) 
begin 
declare msj varchar(50);
declare existencia int;
	set existencia = (select count(*) from tUsuarios where nombre = xusr and psw = xpsw);
	if(existencia = 0)then 
		set msj = "No hay usuario";
	else
		update tUsuarios set psw = xnpsw, tipoUsr= xtipo where nombre = xusr ; 
        set msj = "grrrr";
	end if;
    select msj as Resultado;
end; **
delimiter ;
call actUsr('ted','2712', '1', '2712');

select * from tUsuarios;

