<?php include("conexion.php");
session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <?php 
     $id_type_query = mysqli_query($conn,"SELECT id_usertype FROM `usuarios` WHERE name = '".$_SESSION['usuario']."';");
     $id_type_query = $id_type_query->fetch_array();
     $id_type = intval($id_type_query[0]);
     $user_type_query = mysqli_query($conn,"SELECT type FROM `usertype` WHERE id = ".$id_type.";");
     $user_type_query = $user_type_query->fetch_array();
     $user_type = intval($user_type_query[0]);
    ?>
    <h1>¡Bienvenido <?php echo $_SESSION['usuario']; ?>!</h1>
    <form action="editar.php" method="post">
        <button>Editar mi usuario</button>
</br>
</br>
    </form>
    <?php 
        if($user_type == 1){
            ?>
            <form action="admin.php" method="post">
            <button>Herramientas del administrador</button>
            </br>
            </br>
            </form>
            <?php
        }
    ?>
    <a href="cerrar.php">Cerrar</a>
</body>
</html>