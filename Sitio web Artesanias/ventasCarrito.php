<?php

session_start();
require 'funciones.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    require 'vendor/autoload.php';
    $producto = new Artesanias\productoCarrito;
    $resultado = $producto->mostrarPorId($id);

    if (!$resultado)
        header('Location: html/carrito.php');

    if (isset($_SESSION['carrito'])) { //SI EL CARRITO EXISTE
        //SI EL PRODUCTO EXISTE EN EL CARRITO
        if (array_key_exists($id, $_SESSION['carrito'])) {
            actualizarProducto($id);
        } else {
            //SI EL CARRITO NO EXISTE EN EL CARRITO
            agregarProducto($resultado, $id);
        }
    } else {
        //SI EL CARRITO NO EXISTE
        agregarProducto($resultado, $id);
    }
}


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ARTESANIAS FORCAR</title>
    <meta name="description" content="Empresa fabricante y comercializadora de alcancias en yeso." />
    <meta name="author" content="Artesanías Forcar" />
    <meta name="keywords" content="venta,compra,alcancias,cúcuta,forcar" />
    <link rel="shortcut icon" href="imagenes/Logo.jpeg" type="image/x-icon">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="css/estilos_compra.css">
    
</head>

<body>
    <header>
        <nav>
            <a href="" class="enlace"><img src="imagenes/Logo.jpeg" alt="Logo" width="60" height="60" class="logo"></a>
            <a class="artesanias" href="index.html">ARTESANIAS FORCAR</a>

            <ul>
                <button class="btn-menu" onclick="accion()">Menú</button>
                <li>
                    <a class="nav-enlace desaperece" href="html/index.html">INICIO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="html/portafolio.html">PORTAFOLIO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="html/carrito.php">CARRITO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="html/Login.php">LOGIN</a>
                </li>
            </ul>
        </nav>
        <script src="../js/funciones.js"></script>
    </header>
    <main>
        <section>
            <div class="container" id="main">

                <table class="table table-dark table-hover">
                    <thead>
                        <tr class="text-primary">
                            <th>#</th>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                            $c = 0;
                            foreach ($_SESSION['carrito'] as $indice => $value) {
                                $c++;
                                $total = $value['precio'] * $value['cantidad'];
                        ?>
                                <tr>
                                    <form action="actualizar_carrito.php" method="POST">
                                        <td><?php print $c ?></td>
                                        <td><?php print $value['titulo']  ?></td>
                                        <td>
                                            <?php
                                            $foto = 'upload/' . $value['imagen'];
                                            if (file_exists($foto)) {
                                            ?>
                                                <img src="<?php print $foto; ?>" width="80">
                                            <?php } else { ?>
                                                <img src="assets/imagenes/not-found.jpg" width="250">
                                            <?php } ?>
                                        </td>
                                        <td>$<?php print $value['precio']  ?></td>
                                        <td>
                                            <input type="hidden" name="id" value="<?php print $value['id'] ?>">
                                            <input type="text" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>">
                                        </td>
                                        <td>
                                            $ <?php print $total  ?>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-xs ">Actualizar</button>

                                            <a href="eliminar_carrito.php?id=<?php print $value['id'] ?>" class="btn btn-danger btn-xs">
                                                Eliminar
                                            </a>
                                        </td>
                                    </form>
                                </tr>

                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">Total</td>
                            <td>$<?php print calcularTotal(); ?></td>
                            <td></td>
                        </tr>

                    </tfoot>
                </table>
                <hr>
                <?php
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                ?>
                    <div class="row">
                        <div class="pull-left">
                            <a href="html/carrito.php" class="btn btn-info">Seguir Comprando</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-success finalizarcompra">Finalizar Compra</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            <script src="assets/js/bootstrap.min.js"></script>
        </section>
    </main>
</body>
<footer>

    <h2 class="contenedor-final-diseñado">Artesanias Forcar</h2>
    <h6 class="contenedor-final-derechos">&copy;Derechos Reservados</h6>


</footer>

</html>