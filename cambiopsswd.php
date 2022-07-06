<?php include("conexion.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="cambiopsswd.php" method="post">
    <h1>Cambiar contraseña:</h1>
    <h3>Introduce usuario:</h3>
    <input type="text" name="usuariocambiopsswd" value="" placeholder="Introduzca su nombre" required>
    <h3>Introduce tu nueva contraseña:</h3>
    <input type="password" name="contraseniacambiopsswd" value="" placeholder = "Introduzca su contraseña" required>
    <h3>Introduce email:</h3>
    <input type="text" name="emailcambiopsswd" value="" placeholder = "Introduzca su email" required>
    <h3>Introduce tu DNI:</h3>
    <input type="text" name="dnicambiopsswd" value="" placeholder = "Introduzca su DNI" required>
    </br>
    </br>
    <button type="submit">Cambiar</button>
    </br>
    </br>
    <a href="index.php">Volver</a>
    </form>

    <?php 
        if($_POST){
            $name = $_POST['usuariocambiopsswd'];
            $name_bool = FALSE;
            $psswd = $_POST['contraseniacambiopsswd'];
            $psswd_bool = FALSE;
            $email = $_POST['emailcambiopsswd'];
            $email_bool = FALSE;
            $dni = $_POST['dnicambiopsswd'];
            $dni_bool = FALSE;
            
            if(preg_match('[^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$]',$name)){
                $name_bool=TRUE;
            }
            if(preg_match('[^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$]',$psswd)){
                $psswd_bool = TRUE;
            }
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_bool=TRUE;
            }
            if(preg_match('/[0-9]{7,8}[A-Z]/', $dni)){
                $dni_bool = TRUE;
            }
            if(($name_bool )&&($psswd_bool)&&($email_bool)&&($dni_bool)){
            $query = mysqli_query($conn, "SELECT * FROM `usuarios`  WHERE name='".$name."' AND dni='".$dni."' AND email='".$email."';");
            $nr = mysqli_num_rows($query);
            if($nr==1){
                $id_pass_query= mysqli_query($conn,"SELECT id_psswd FROM `usuarios` WHERE name='".$name."' AND dni='".$dni."' AND email='".$email."';");
                $id_pass_query = $id_pass_query->fetch_array();
                $id_password = intval($id_pass_query[0]);
                $query= mysqli_query($conn,"UPDATE `passwords` SET psswd = '".$psswd."' WHERE id=".$id_password.";");
                ?> <p style="color:green">Contraseña cambiada correctamente</p> <?php
            }else{
                ?> <p style="color:red">Error al cambiar la contraseña, introduzca los datos correctamente.</p> <?php
            }
            
        }
    }
    
    
    
    
    ?>
</body>
</html>