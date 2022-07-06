<?php include("conexion.php");?>

 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<h1>Registro:</h1>
    
    <form action="registro.php" method="post">
    <h3>Nuevo nombre de usuario:</h3>
    <input type="text" name="usuarioregistro" value = "" placeholder = "Introduzca su nombre" required>
    <h3>Nueva contraseña:</h3>
    <input type="password" name="contraseniaregistro" value = "" placeholder = "Introduzca su contraseña" required>
    <h3>Escribe un email:</h3>
    <input type="text" name="emailregistro" value = "" placeholder = "Introduzca su email" required>
    <h3>Escribe tu DNI:</h3>
    <input type="text" name="dniregistro" value = "" placeholder = "Introduzca su DNI" required>
    </br>
    </br>
    <button type="submit">Registrarse</button>
    </br>
    </br>
    <a href="index.php">Volver</a>
    </form>
</body>
</html>
<?php if($_POST){
    $name = $_POST["usuarioregistro"];
    $pass = $_POST["contraseniaregistro"];
    $email = $_POST["emailregistro"];
    $dni = $_POST["dniregistro"];
    $query = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE name='".$name."';");
    $nr = mysqli_num_rows($query);

    if($nr==0){ ?>
        <p style="color:green"><?= "Bienvenido ".$name; ?></p>
        <?php
        $cryptpass = password_hash($pass,PASSWORD_DEFAULT,['cost'=>10]);
        $query= mysqli_query($conn,"INSERT INTO `passwords` (psswd) VALUES ('".$pass."');");
        $query= mysqli_query($conn,"INSERT INTO `usertype` (type) VALUES (0);");
        $id_pass_query = mysqli_query($conn,"SELECT MAX(id) FROM `passwords` WHERE psswd ='".$pass."';");
        $id_type_query = mysqli_query($conn,"SELECT MAX(id) FROM `usertype`;");
        $id_pass_query = $id_pass_query->fetch_array();
        $id_password = intval($id_pass_query[0]);
        $id_type_query = $id_type_query->fetch_array();
        $id_type = intval($id_type_query[0]);
        $query= mysqli_query($conn,"INSERT INTO `usuarios` (name,email,dni,id_psswd,id_usertype) VALUES ('".$name."','".$email."','".$dni."',".$id_password.",".$id_type.");");
        

        

       
        header("Location:index.php");

    }else{ ?>
        <p style="color:red"><?= "Usuario ya escogido"; ?></p>
    <?php }
    } ?>