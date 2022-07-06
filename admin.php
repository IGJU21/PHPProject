<?php include("conexion.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herramientas del administrador</title>
</head>
<body>
    <h1>Herramientas del administrador: <?= $_SESSION['usuario']; ?></h1>
    <form action="admin.php" method = 'post'>
    <input type="submit" name="mostrarregistros" value="Mostrar todos los registros"><br><br>
    </form>
    <?php 
    if(isset($_POST['mostrarregistros'])){
        $query = mysqli_query($conn, "SELECT id,name,email,dni FROM `usuarios`;");
        ?>
        <table border="1px solid"><tr>
            <thead>
            <th scope="col">Nombre</th>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">DNI</th>
            </thead>
        </tr><?php
        while($row = $query->fetch_array()){
            $id = $row[0];
            $name = $row[1];
            $email = $row[2];
            $dni = $row[3];
            ?>
            
            <tr>
                <td><?= $name; ?></td>
                <td><?= $id;?></td>
                <td><?= $email;?></td>
                <td><?= $dni;?></td>
            </tr>
            
        <?php
        }
        ?></table><br><?php
    }
    ?>
    <form action="admin.php" method = 'post'>
    <input type="submit" name="mostraradministradores" value="Mostrar todos los administradores"><br><br>
    </form>
    <?php 
    if(isset($_POST['mostraradministradores'])){
        $query = mysqli_query($conn, "SELECT usuarios.id,usuarios.name,usuarios.email,usuarios.dni FROM `usuarios` JOIN `usertype` ON usuarios.id_usertype = usertype.id WHERE type = 1;");
        ?>
        <table border="1px solid"><tr>
            <thead>
            <th scope="col">Nombre</th>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">DNI</th>
            </thead>
        </tr><?php
        while($row = $query->fetch_array()){
            $id = $row[0];
            $name = $row[1];
            $email = $row[2];
            $dni = $row[3];
            ?>
            <tr>
                <td><?= $name; ?></td>
                <td><?= $id;?></td>
                <td><?= $email;?></td>
                <td><?= $dni;?></td>
            </tr>           
        <?php
        }
        ?></table><?php
    }
    ?>
    <br>
    <a href="usuario.php">Volver</a>
</body>
</html>