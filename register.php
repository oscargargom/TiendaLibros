<?php

/*

            $servidor = "dwes.lan";
            $nombreusuario = "root";
            $password = "usuario";
            $db = "tiendaLibros";
        
            $conexion = new mysqli($servidor, $nombreusuario, $password, $db);
        
            if($conexion->connect_error){
                die("Conexión fallida: " . $conexion->connect_error);
            }

            if(isset($_POST['nombreCompleto'])){
              $nombre = $_POST['nombreCompleto'];
              $usuario = $_POST['username'];
              $email = $_POST['email'];
              $telefono = $_POST['telefono'];
              $password = $_POST['password'];
                
                $sql = "INSERT INTO usuarios(nombreCompleto, username, email, telefono, password, rol_id) 
                            
                VALUES('$nombre', '$usuario', '$email', '$telefono', '$password', 2)";
                
                if($conexion->query($sql) === true){
                  header('location: login.php');
                }else{
                    die("Error al insertar datos: " . $conexion->error);
                }
                $conexion->close();
            }
*/
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/styleRegister.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registrarse</div>
    <div class="content">
      <form method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre completo</span>
            <input type="text" placeholder="Enter your name" required name="nombreCompleto">
          </div>
          <div class="input-box">
            <span class="details">Nombre de usuario</span>
            <input type="text" placeholder="Enter your username" required name="username">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required name="email">
          </div>
          <div class="input-box">
            <span class="details">Número de Teléfono</span>
            <input type="text" placeholder="Enter your number" name="telefono">
          </div>
          <div class="input-box">
            <span class="details">Contraseña</span>
            <input type="text" placeholder="Enter your password" required name="password">
          </div>
          <div class="input-box">
            <span class="details">Confirmar contraseña</span>
            <input type="text" placeholder="Confirm your password" required>
          </div>
        </div>

        <div class="button">
          <input type="submit" value="Register">
        </div>

        <div class="bottom-text" style="text-align: center;"><br>
            ¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a><br><br>
        </div>


      </form>
    </div>
  </div>

</body>
</html>
