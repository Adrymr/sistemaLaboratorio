<?php
include_once ('connection.php');

if(isset($_POST['btn-create']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['ingredients']) && isset($_POST['dpt'])){

    $code = $_POST['code'];
    $name =  $_POST['name'];
    $inci = $_POST['ingredients'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $dpt = $_POST['dpt'];

    $query = "INSERT INTO products (code, name, ingredients, price, quantity, id_dpt) VALUES ('$code', '$name', '$inci', '$price', '$quantity', '$dpt')";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $message = "Producto registrado con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/products.php'
            </script>";
}
?>