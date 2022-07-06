
<?php include("conexion.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script type="text/javascript">
function ConfirmDelete()
{
    var respuesta = confirm("¿Estás seguro de que deseas eliminar el usuario?");

    if (respuesta == true){
        return true;
    }
    else{
        return false;
    }
}

</script>
<body>
   
<h1>Editar usuario: <?php echo $_SESSION['usuario']; ?></h1>
<!-- BOTÓN EDITAR NOMBRE DE USUARIO -->
        <form action="editar.php" method="post">
            
    <input type="submit" name="usuarioeditarbtn" value="Editar mi nombre">
    </form>
    <?php if(isset($_POST["usuarioeditarbtn"])){ ?>
         </br><form action="editar.php" method="post"> 
            <input type="text" name="usuarioeditar"> <input type="submit" required>
        </form>
        <?php } ?>
    
    </br>
          <!-- BOTÓN EDITAR CONTRASEÑA -->
          <form action="editar.php" method="post">
            
    <input type="submit" name="contraseniaeditarbtn" value="Editar mi contraseña">
    </form>
    <?php if(isset($_POST["contraseniaeditarbtn"])){ ?>
         </br><form action="editar.php" method="post"> 
            <input type="text" name="contraseniaeditar"> <input type="submit" required>
        </form>
        <?php } ?>
    
    </br>
         <!-- BOTÓN EDITAR EMAIL -->
         <form action="editar.php" method="post">
    
    <input type="submit" name="emaileditarbtn" value="Editar mi email">
    </form>
    <?php if(isset($_POST["emaileditarbtn"])){ ?>
         </br><form action="editar.php" method="post"> 
            <input type="text" name="emaileditar"> <input type="submit" required>
        </form>
        <?php } ?>
    
    </br>
         <!-- BOTÓN EDITAR DNI -->
         <form action="editar.php" method="post">
    
    <input type="submit" name="dnieditarbtn" value="Editar mi DNI">
    </form>
    <?php if(isset($_POST["dnieditarbtn"])){ ?>
         </br><form action="editar.php" method="post"> 
            <input type="text" name="dnieditar"> <input type="submit" required>
        </form>
        <?php } ?>
        </br>

        <!-- BOTÓN ELIMINAR USUARIO -->
        <form action="editar.php" method="post">
    <input type="submit" name="eliminarbtn" value="Eliminar mi cuenta" onclick="return ConfirmDelete()">
    </form>
        </br>
        <a href="usuario.php">Volver</a>
        <!-- EDITAR NOMBRE DE USUARIO -->
         <?php if(isset($_POST['usuarioeditar'])){
                 $name = $_POST['usuarioeditar'];
                 if(preg_match('[^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$]',$name)){ //Comprueba si tiene un mínimo de 8 caracteres y si contiene al menos 1 letra y 1 número
                    $query = mysqli_query($conn, "SELECT * FROM `usuarios`  WHERE name='".$name."';");
                    $nr = mysqli_num_rows($query);
                    if($nr==0){
                        $actual_name = $_SESSION['usuario'];
                        $query= mysqli_query($conn,"UPDATE `usuarios` SET name = '".$name."' WHERE name = '".$actual_name."'");
                        $_SESSION['usuario']=$name;
                        header("Location:editar.php");
                    }else{
                        ?><p style="color:red;">Nombre de usuario ya escogido</p> <?php
                        }
                    }else{ ?>
                        <p style="color:red;">Introduzca un nombre válido</p>
                    <?php }
                }
        // <!-- EDITAR CONTRASEÑA -->
                if(isset($_POST['contraseniaeditar'])){
                    if($_POST['contraseniaeditar'] != NULL){
                        
                        $psswd = $_POST['contraseniaeditar'];
                        $actual_name = $_SESSION['usuario'];
                        if(preg_match('[^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$]',$psswd)){//Comprueba si tiene un mínimo de 8 caracteres y si contiene al menos 1 letra y 1 número
                            $id_psswd=mysqli_query($conn,"SELECT id_psswd FROM `usuarios`  WHERE name='".$actual_name."';");
                            $id_pass_query = $id_psswd->fetch_assoc();
                            $id_password = intval($id_pass_query['id_psswd']);
                            $query= mysqli_query($conn,"UPDATE `passwords` SET psswd = '".$psswd."' WHERE id=".$id_password.";");
                            header("Location:editar.php");
                        }else{ ?>
                            <p style="color:red;">Introduzca algún valor válido en el formulario</p>
                            <?php }
                     // <!-- EDITAR EMAIL -->
                    }
        }
            if(isset($_POST['emaileditar'])){
                if($_POST['emaileditar'] != NULL){
                    $email = $_POST['emaileditar'];
                    $actual_name = $_SESSION['usuario'];
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        ?><p style="color:red;">Introduzca algún valor en el formulario</p><?php
                    }else{ 
                        $query= mysqli_query($conn,"UPDATE `usuarios` SET email = '".$email."' WHERE name = '".$actual_name."';");
                        header("Location:editar.php"); 
                    }
                // <!-- EDITAR DNI -->
                 }
        }
            if(isset($_POST["dnieditar"])){
                if($_POST['dnieditar'] != NULL){
                    $dni = $_POST["dnieditar"];
                    $actual_name = $_SESSION['usuario'];
                    if(preg_match('/[0-9]{7,8}[A-Z]/', $dni)){
                    $query= mysqli_query($conn,"UPDATE `usuarios` SET dni = '".$dni."' WHERE name = '".$actual_name."';");
                    header("Location:editar.php");
            }else{ ?>
                <p style="color:red;">Introduzca algún valor en el formulario</p>
                <?php }
                // <!-- BOTÓN ELIMINAR -->
            }}
            if(isset($_POST["eliminarbtn"])){
                $actual_name = $_SESSION['usuario'];
                $id_pass_del_query=mysqli_query($conn,"SELECT id_psswd FROM `usuarios`  WHERE name='".$actual_name."';");
                $id_pass_query = $id_pass_del_query->fetch_array();
                $id_pass_query = intval($id_pass_query[0]);
                $id_type_del_query=mysqli_query($conn,"SELECT id_usertype FROM `usuarios`  WHERE name='".$actual_name."';");
                $id_type_query = $id_type_del_query->fetch_array();
                $id_type_query = intval($id_type_query[0]);
                $query= mysqli_query($conn,"DELETE FROM `usuarios` WHERE name = '".$actual_name."';");
                $query= mysqli_query($conn,"DELETE FROM `passwords` WHERE id = ". $id_pass_query.";");
                $query= mysqli_query($conn,"DELETE FROM `usertype` WHERE id = ". $id_type_query.";");
                header("Location:cerrar.php");
            }
           
          ?>
         
    
    
</body>
</html>
