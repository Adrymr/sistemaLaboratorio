<?php
ob_start();

include_once ('connection.php');

if(!empty($_GET['id'])){
    $idOrder = $_GET['id'];
    $query = "UPDATE purchase_orders SET estatus='Procesada' WHERE id='$idOrder'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($result == true){
        $message = "orden de compra procesada con exito";
        echo "<script>
                    alert('$message');
                    window.location= '../views/purchasesList.php'
            </script>";
    }
}

ob_end_flush();
?>