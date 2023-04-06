<?php

include_once ('connection.php');

if(isset($_POST['btn-create']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['rol'])){

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $idRol = $_POST['rol'];

    $query = "INSERT INTO users (nameUser, passUser, emailUser, idRol_user) VALUES ('$user', '$pass', '$email', '$idRol')";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Usuario registrado con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/home.php'
            </script>";

}
?>