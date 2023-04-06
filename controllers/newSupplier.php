<?php

include_once ('connection.php');

if(isset($_POST['btn-create']) && isset($_POST['name']) && isset($_POST['rif']) && isset($_POST['address']) && isset($_POST['phoneNumber'])){

    $nameS = $_POST['name'];
    $rifS = $_POST['rif'];
    $addressS = $_POST['address'];
    $pNumberS = $_POST['phoneNumber'];

    $query = "INSERT INTO suppliers (nameS, rifS, addressS, phoneNumberS) VALUES ('$nameS', '$rifS', '$addressS', '$pNumberS')";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Proveedor registrado con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/suppliers.php'
            </script>";

}
?>