<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="imagenes/Logo.jpeg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
   <form action="../InicioSesion.php" method="post">
   <h1 class="animate__animated animate__backInLeft">Iniciar Sesion</h1>
   <p>Usuario <input type="text" placeholder="ingrese su nombre" name="usuario"></p>
   <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="contrasena"></p>
   <input type="submit" value="Ingresar">
   
   </form> 
   <a href="../html/index.html"><button class="btn btn-danger">Regresar</button></a>
   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>