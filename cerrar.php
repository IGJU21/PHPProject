<?php header("Location:index.php");
    session_destroy();
    mysqli_close($conn);
?>