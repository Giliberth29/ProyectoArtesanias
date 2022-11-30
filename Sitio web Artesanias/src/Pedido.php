<?php

namespace Artesanias;

class Pedido
{

    private $config;
    private $cn = null;

    public function __construct()
    {

        $this->config = parse_ini_file(__DIR__ . '/../config.ini');

        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function registrar($_params)
    {
        $sql = "INSERT INTO `pedidos`(`cliente_id`, `total`, `fecha`) 
        VALUES (:cliente_id,:total,:fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":cliente_id" => $_params['cliente_id'],
            ":total" => $_params['total'],
            ":fecha" => $_params['fecha'],

        );

        if ($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

    public function registrarDetalle($_parametros)
    {
        $sql = "INSERT INTO `detalle_pedidos`(`pedido_id`, `producto_id`, `precio`, `cantidad`) 
        VALUES (:pedido_id,:producto_id,:precio,:cantidad)";

        $resultado = $this->cn->prepare($sql);

        $array = array(
            ":pedido_id" => $_parametros['pedido_id'],
            ":producto_id" => $_parametros['producto_id'],
            ":precio" => $_parametros['precio'],
            ":cantidad" => $_parametros['cantidad'],
        );

        if ($resultado->execute($array))
            return true;

        return false;
    }

    public function mostrar()
    {
        $sql = "SELECT p.id, nombre,direccion, total, fecha FROM pedidos p
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id";
        $resultado = $this->cn->prepare($sql);
        if($resultado->execute())
            return $resultado->fetchAll();
            
        return false;
    }

    public function mostrarUltimos()
    {
        $sql = "SELECT p.id, nombre,direccion, total, fecha FROM pedidos p
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id LIMIT 10";
        $resultado = $this->cn->prepare($sql);
        if($resultado->execute())
            return $resultado->fetchAll();
            
        return false;
    }

    public function mostrarPorId($id)
    {
        $sql = "SELECT p.id, nombre,direccion, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id WHERE p.id = :id";

        $resultado = $this->cn->prepare($sql);

        $array = array(
            ':id'=>$id
        );

        if($resultado->execute($array ))
            return  $resultado->fetch();

        return false;
    }

    public function mostrarDetallePorIdPedido($id)
    {
        $sql = "SELECT 
                dp.id,
                pe.titulo,
                dp.precio,
                dp.cantidad,
                pe.imagen
                FROM detalle_pedidos dp
                INNER JOIN productos pe ON pe.id= dp.producto_id
                WHERE dp.pedido_id = :id";

        $resultado = $this->cn->prepare($sql);

        $array = array(
            ':id'=>$id
        );

        if($resultado->execute($array))
            return  $resultado->fetchAll();

        return false;

    }
}
