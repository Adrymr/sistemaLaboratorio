<?php
error_reporting(0);
session_start();
ob_start();

include_once ('connection.php');

if (isset($_POST['btn-login']) && isset($_POST['inputUser']) && !empty($_POST['inputUser']) && isset($_POST['inputPassword']) && !empty($_POST['inputPassword'])){

    $user = $_POST['inputUser'];
    $pass = $_POST['inputPassword'];

    $query = "SELECT * FROM users WHERE nameUser = '$user' AND passUser = '$pass'"; 
    $rs = mysqli_query($conn, $query) or die("Error: " . mysqli_error($conn));
    $rows = mysqli_num_rows($rs);
    
    if ($data = mysqli_fetch_array($rs)){
        $_SESSION['name'] = $data['nameUser'];
        $_SESSION['id'] = $data['idUser'];
        $_SESSION['idRol'] = $data['idRol_user'];

        echo "<meta http-equiv= 'refresh' content='0; url=../views/home.php'>";
        
    } else { 
        $message = "usuario o contraseña incorrecta";
        echo "<script>
                    alert('$message');
                    window.location= '../index.html'
            </script>";
        }
}

ob_end_flush();
?>