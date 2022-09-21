create or replace trigger Trigger3 
before insert ON Movi_Detalle 
for each row 
declare 
vTipoMov varchar;
vCantidadBodegaMes number; 
vCantidadExistente number;
vCantidadMaxima number;
vDiferencia number;
vProducto varchar;

Begin 
    Select tipoMov into vTipoMov  
    from Movimiento  
    where idMovimiento=:new.idMovimiento; 
 
    if vTipoMov="ENTRADA" then
            --SELECCIONAR LA CANTIDAD DE PRODUCTOS EN EL MES QUE SE ENCUENTRA LA FECHA DEL MOVIMIENTO
            select sum(md.cantidad) into vCantidadBodegaMes
            from Movi_Detalle md inner join Movimiento m on md.idMovimiento=m.idMovimiento
            where m.fecha --ENTRE EL INICIO DEL MES DEL MOVIMIENTO Y EL FINAL DEL MES
            between to_date(to_char(:new.fecha,'yyyy-mm-01'),'yyyy-mm-dd') and to_date(to_char(last_day(:new.fecha),'yyyy-mm-dd'),'yyyy-mm-dd') and md.idProducto=:new.idProducto;

            --Sumar la cantidad de productos que se quieren ingresar a la bodega
            vCantidadBodegaMes:=vCantidadBodegaMes+:new.cantidad;

            --Seleccionar la cantidad maxima permitida de productos
            select cantidadMaximaMes into vCantidadMaxima
            from Topes where idProducto=:new.idProducto;

            --Si la cantidad de productos en el mes es mayor a la cantidad maxima permitida
            if vCantidadBodegaMes>vCantidadMaxima then
                --Obtenga la diferencia
                vDiferencia:=vCantidadBodegaMes-vCantidadMaxima;

                --Seleccionar el producto
                select nombre into vProducto
                from Producto where idProducto=:new.idProducto;

                Raise_application_error(-20000, 'La entrada no se puede realizar porque el articulo '||vProducto||' supera el limite de '||vCantidadMaxima||' unidades por mes con una diferencia de '||vDiferencia||' unidades');
            end if;
    end if;
end;