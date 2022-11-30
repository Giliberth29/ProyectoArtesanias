<?php

 
if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    require 'vendor/autoload.php';
    $loginUser = new Artesanias\Usuario;
    
    $resultado = $loginUser->loginUsuario($usuario,$contrasena);

    if($resultado){
        session_start();
        $_SESSION['usuario_info'] = array(
            'usuario' => $resultado['usuario'],
            'estado' => 1
        );
        header('Location: VistaAdmin.php');
    }else{
        echo '<script language="javascript">alert("Error de autentificacion");
        window.location.href="Login.php"</script>';
    }
}
