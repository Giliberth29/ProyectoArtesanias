<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ARTESANIAS FORCAR</title>
    <meta name="description" content="Empresa fabricante y comercializadora de alcancias en yeso." />
    <meta name="author" content="Artesanías Forcar" />
    <meta name="keywords" content="venta,compra,alcancias,cúcuta,forcar" />
    <link rel="shortcut icon" href="../imagenes/Logo.jpeg" type="image/x-icon">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../css/carrito.css">
</head>

<body>
    <header>
        <nav>
            <a href="" class="enlace"><img src="../imagenes/Logo.jpeg" alt="Logo" width="60" height="60" class="logo"></a>
            <a class="artesanias" href="index.html">ARTESANIAS FORCAR</a>

            <ul>
                <button class="btn-menu" onclick="accion()">Menú</button>
                <li>
                    <a class="nav-enlace desaperece" href="index.html">INICIO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="portafolio.html">PORTAFOLIO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="carrito.html">CARRITO</a>
                </li>
                <li>
                    <a class="nav-enlace desaperece" href="Login.php">LOGIN</a>
                </li>
            </ul>
        </nav>
        <script src="../js/funciones.js"></script>
    </header>

    <section class="Carrito">
        <div class="row row-cols-sm-1 row-cols-lg-2 row-cols-xl-3">

            <?php
            require '../vendor/autoload.php';
            $producto = new Artesanias\productoCarrito;
            $info_producto = $producto->mostrar();
            $cantidad = count($info_producto);
            if ($cantidad > 0) {
                for ($x = 0; $x < $cantidad; $x++) {
                    $item = $info_producto[$x];
            ?>

                    <div class="col d-flex justify-content-center mb-3">
                        <div class="card shadow mb-1 bg-dark rounded" style="width: 20rem;">
                            <h5 class="card-title pt-2 text-center text-primary"><?php print $item['titulo'] ?></h5>

                            <?php
                            $foto = '../upload/' . $item['imagen'];
                            if (file_exists($foto)) {
                            ?>
                                <img src="<?php print $foto; ?>" class="card-img" width="320" height="300">
                            <?php } else { ?>
                                <img src="../assets/imagenes/not-found.jpg" class="img-responsive card-img">
                            <?php } ?>

                            <div class="card-body">
                                <p class="card-text text-white-50 description"><?php print $item['descripcion'] ?></p>
                                <h5 class="text-primary">Precio: <span class="precio"><?php print $item['precio'] ?></span></h5>
                                <div class="d-grid gap-2">
                                    <a href="../ventasCarrito.php?id=<?php print $item['id'] ?>" class="btn btn-primary button">Añadir a Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php
                }
            } else { ?>
                <h4>NO HAY REGISTROS</h4>



            <?php } ?>

        </div>
    </section>
    <div class="col d-flex justify-content-end">
        <a class="pagar" href="infoCliente.html">PROCEDER AL PAGO</a>
    </div>
</body>
<footer>

    <h2 class="contenedor-final-diseñado">Artesanias Forcar</h2>
    <h6 class="contenedor-final-derechos">&copy;Derechos Reservados</h6>


</footer>

</html>