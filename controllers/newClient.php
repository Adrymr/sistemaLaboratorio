<?php

include_once ('connection.php');

if(isset($_POST['btn-create']) && isset($_POST['name']) && isset($_POST['lastName']) && isset($_POST['dni']) && isset($_POST['address']) && isset($_POST['phoneNumber'])){

    $nameCl = $_POST['name'];
    $ltNameCl = $_POST['lastName'];
    $dniCl = $_POST['dni'];
    $addressCl = $_POST['address'];
    $pNumberCl = $_POST['phoneNumber'];

    $query = "INSERT INTO clients (nameC, lastNameC, dniC, addressC, phoneNumberC) VALUES ('$nameCl', '$ltNameCl', '$dniCl', '$addressCl', '$pNumberCl')";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Cliente registrado con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/clients.php'
            </script>";

}
?>