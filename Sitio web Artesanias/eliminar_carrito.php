<?php
session_start();

if(!isset($_GET['id']) OR !is_numeric(($_GET['id'])))
    header('Location: ventasCarrito.php');
    $id = $_GET['id'];
    if(isset($_SESSION['carrito'])){
        unset($_SESSION['carrito'][$id]);
        header('Location: ventasCarrito.php');
    }else{
        header('Location: ventasCarrito.php');

    }