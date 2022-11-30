<?php
require 'vendor/autoload.php';

$producto = new Artesanias\productoCarrito;

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    if ($_POST['accion']==='Registrar'){

        if(empty($_POST['titulo']))
            exit('Completar titulo');
        
        if(empty($_POST['descripcion']))
            exit('Completar titulo');

        if(empty($_POST['categoria_id']))
            exit('Seleccionar una Categoria');

        if(!is_numeric($_POST['categoria_id']))
            exit('Seleccionar una Categoria válida');

        $_parametros = array(
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            'imagen'=> subirFoto(),
            'precio'=>$_POST['precio'],
            'categoria_id'=>$_POST['categoria_id'],
            'fecha'=> date('Y-m-d')
        );

        $rpt = $producto->registrar($_parametros);

        if($rpt)
            header('Location: Productos/productos.php');
        else
            print 'Error al registrar una producto';

    }

    if ($_POST['accion']==='Actualizar'){

        if(empty($_POST['titulo']))
            exit('Completar titulo');
        
        if(empty($_POST['descripcion']))
            exit('Completar titulo');

        if(empty($_POST['categoria_id']))
            exit('Seleccionar una Categoria');

        if(!is_numeric($_POST['categoria_id']))
            exit('Seleccionar una Categoria válida');

        
        $_parametros = array(
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            'precio'=>$_POST['precio'],
            'categoria_id'=>$_POST['categoria_id'],
            'fecha'=> date('Y-m-d'),
            'id'=>$_POST['id'],
        );

        if(!empty($_POST['foto_temp']))
        $_parametros['imagen'] = $_POST['foto_temp'];

        if(!empty($_FILES['imagen']['name']))
        $_parametros['imagen'] = subirFoto();


        $rpt = $producto->actualizar($_parametros);
        if($rpt)
            header('Location: Productos/productos.php');
        else
            print 'Error al actualizar un producto';

       
    }

}

if($_SERVER['REQUEST_METHOD'] ==='GET'){

    $id = $_GET['id'];
    $rpt = $producto->eliminar($id);

    if($rpt)
        header('Location: Productos/productos.php');
    else
        print 'Error al eliminar una producto';

}
function subirFoto() {

    $carpeta = __DIR__.'//upload/';

    $archivo = $carpeta.$_FILES['imagen']['name'];

    move_uploaded_file($_FILES['imagen']['tmp_name'],$archivo);

    return $_FILES['imagen']['name'];


}




