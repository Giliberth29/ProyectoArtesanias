<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'funciones.php';
    require 'vendor/autoload.php';

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new Artesanias\Cliente;

        $_parametros = array(
            'nombre' => $_POST['nombre'],
            'documento' => $_POST ['documento'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion'],
            'comentario' => $_POST['comentario'],
        );

        $cliente_id = $cliente->registrar($_parametros);

        $pedido = new Artesanias\Pedido;

        $_parametros = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d'),
        );

        $pedido_id = $pedido->registrar($_parametros);

        foreach ($_SESSION['carrito'] as $indice => $value) {
            $_parametros = array(
                "pedido_id" =>  $pedido_id,
                "producto_id" => $value['id'],
                "precio" => $value['precio'],
                "cantidad" => $value['cantidad'],
            );
            $pedido -> registrarDetalle(($_parametros));
        }
        $_SESSION['carrito'] = array();
        header('Location: html/elegirBanco.html');
    }
}
