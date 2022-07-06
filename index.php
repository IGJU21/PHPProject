<?php include("conexion.php");
    session_start(); 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>

    <h1>Login:</h1>
    
    <form action="index.php" method="post">
    <h3>Usuario:</h3>
    <input type="text" name="usuario" placeholder="Introduzca su nombre">
    <h3>Contraseña:</h3>
    <input type="password" name="contrasenia" placeholder="Introduzca su contraseña">
    </br>
    </br>
    <button type="submit">Enviar</button>
    </br>
    </br>
    <a href="registro.php">Registrarse</a>
    </br>
    </br>
    <a href="cambiopsswd.php">¿Has olvidado la contraseña?</a>
    </form>
</body>
</html>


<?php if($_POST){
    $name = $_POST["usuario"];
    $pass = $_POST["contrasenia"];
    $cryptpass= password_hash($pass,PASSWORD_DEFAULT,['cost'=>10]);
    $query = mysqli_query($conn, "SELECT * FROM `usuarios` INNER JOIN `passwords` ON  usuarios.id_psswd = passwords.id WHERE usuarios.name='".$name."' AND passwords.psswd='".$pass."';");
    $nr = mysqli_num_rows($query);

        if($nr==1){ 
            header("Location:usuario.php");
            $_SESSION['email'] = mysqli_query($conn,"SELECT email FROM `usuarios` WHERE name='".$name."';" );
            $_SESSION['usuario']=$name;
        }else{ ?>
            <p style="color:red"><?= "Usuario o contraseña incorrectos"; ?></p>        
        <?php }
        }
        ?>
