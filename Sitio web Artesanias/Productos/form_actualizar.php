<?php
session_start();

if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info']))
  header('Location: ../Login.php');

?>


<?php
  require '../vendor/autoload.php';

  if(isset($_GET['id']) && is_numeric($_GET['id'])){
      $id = $_GET['id'];
    
      $producto = new Artesanias\productoCarrito;
      $resultado = $producto->mostrarPorId($id);

      if(!$resultado)
          header('Location: productos.php');

  }else{
    header('Location: productos.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
  <meta charset="utf-8" />
    <title>Artesanías Forcar</title>
    <meta name="description" content="Empresa fabricante y comercializadora de alcancias en yeso." />
    <meta name="author" content="Artesanías Forcar" />
    <meta name="keywords" content="venta,compra,alcancias,cúcuta,forcar" />



    <link rel="shortcut icon" href="../Imagenes/Logo.jpeg" type="image/x-icon">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Raleway:500,600&display=swap" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../VistaAdmin.php">Artesanías Forcar</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="../pedidos/pedidos.php" class="btn">Pedidos</a>
            </li> 
            <li class = "active">
              <a href="productos.php" class="btn">Productos</a>
            </li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php print $_SESSION['usuario_info']['usuario']?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../cerrar_Sesion.php">Salir </a></li>
            </ul>
          </li>
          </ul>




        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row">
        <div class="col-md-12">
          <fieldset>
            <legend>Datos de los productos</legend>
            <form method="POST" action="../acciones.php" enctype="multipart/form-data" >
              <input type="hidden" name="id" value="<?php print $resultado['id'] ?>">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titulo</label>
                          <input value="<?php print $resultado['titulo'] ?>" type="text" class="form-control" name="titulo" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Descripción</label>
                          <textarea class="form-control" name="descripcion" id="" cols="3" required><?php print $resultado['descripcion']?>"</textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Categorias</label>
                          <select class="form-control" name="categoria_id" required>
                            <option value="">--SELECCIONE--</option>
                            <?php
                            require '../vendor/autoload.php';
                            $categoria = new Artesanias\categoria;
                            $info_categoria = $categoria->mostrar();
                            $cantidad = count($info_categoria);
                            for($x = 0; $x<$cantidad; $x++){
                              $item = $info_categoria[$x];
                            
                            ?>
                            <option value="<?php print $item['id'] ?>"
                            <?php print $resultado['categoria_id']==$item['id']? 'selected':''?>
                            ><?php print $item['nombre'] ?></option>
                            <?php
                            }
                            ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Foto</label>
                          <input type="file" class="form-control" name="imagen">
                          <input type="hidden" name="foto_temp" value="<?php print $resultado['imagen']?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Precio</label>
                          <input value="<?php print $resultado['precio']?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
                      </div>
                  </div>
              </div>
              <input type="submit" class="btn btn-primary" name="accion" value="Actualizar">
              <a href="productos.php" class="btn btn-default">Cancelar</a>
            </form>
          </fieldset>
        
        </div>
      </div>

    </div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  </body>
</html>
