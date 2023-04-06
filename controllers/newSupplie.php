<?php
include_once ('connection.php');

if(isset($_POST['btn-create']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['cost']) && isset($_POST['quantity'])){

    $code = $_POST['code'];
    $name =  $_POST['name'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO supplies (code, name, cost, quantity) VALUES ('$code', '$name', '$cost', '$quantity')";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Insumo registrado con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/supplies.php'
            </script>";
}
?>