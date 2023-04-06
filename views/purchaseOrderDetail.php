<?php
include_once('../controllers/connection.php');

session_start();

if(isset($_SESSION['name']) && !empty($_GET['id'])){
    $nameUser = $_SESSION['name'];
    $idUser = $_SESSION['id'];
    $rolUser = $_SESSION['idRol'];

    $idOrder = $_GET['id'];
    $total = 0;

    $query = "SELECT * FROM supplies"; 
    $rs = mysqli_query($conn, $query) or die("Error: " . mysqli_error($conn));

    if(!isset($_SESSION['list1']) && !isset($_SESSION['list2'])){
        $_SESSION['list1'] = array ();
        $_SESSION['list2'] = array ();
    }

    if(!isset($_SESSION['list3'])){
        $_SESSION['list3'] = array();
    }

    if(!isset($_SESSION['list4'])){
        $_SESSION['list4'] = array();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laboratorio CleanUp - Panel Principal</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

        

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php"><strong>Laboratorio CleanUp </strong></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuración</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="http://localhost/sistemaLaboratorio/controllers/close.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Opciones</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="orders.php">Pedidos</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="purchaseOrders.php">Ordenes de compra</a>
                                    <a class="nav-link" href="purchasesList.php">Libro de Ordenes</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Inventario
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Productos
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="products.php">Productos</a>
                                            <a class="nav-link" href="supplies.php">Insumos</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>

                            <a class="nav-link" href="clients.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Clientes
                            </a>

                            <a class="nav-link" href="suppliers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Proveedores
                            </a>
                            <div class="sb-sidenav-menu-heading">Reportes</div>
                        
                            <a class="nav-link" href="reports.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reportes
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $nameUser;?> 
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <h1 class="mt-4">Ordenes de compra</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Registro de orden de compra</li>
                            </ol>
                            <div class="card mb-4">
                                <form action="#" method="post">

                                    <div class="form-floating mb-3">
                                        <select class="form-select form-control" name="supplie" aria-label="Default select example" required>
                                        <option></option>
                                            <?php 
                                            while ($data = mysqli_fetch_array($rs)) {
                                                echo "<option value='".$data['id']."'>".$data['name']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="inputType"><i class="fa-solid fa-user"></i> Producto</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="quantity" type="number" required placeholder="cantidad"/>
                                        <label for=""><i class="fa-solid fa-user"></i> Cantidad</label>
                                    </div>
                                
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input type="submit" name="btn-create" value="Agregar" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>

                            <div class="card mb-4">
                                <?php

                                if(isset($_POST['supplie']) && isset($_POST['quantity'])){
                                    $id_supplie = $_POST['supplie'];
                                    $quty = $_POST['quantity'];

                                    $query3 = "SELECT code, name, cost FROM supplies WHERE id = '$id_supplie'"; 
                                    $rs3 = mysqli_query($conn, $query3) or die("Error: " . mysqli_error($conn));
                                    $data3 = mysqli_fetch_array($rs3);

                                    if(isset($_SESSION['list1']) && isset($_SESSION['list2']) && isset($_SESSION['list3'])  && isset($_SESSION['list4'])){

                                        array_push($_SESSION['list1'], $data3['name']);
                                        array_push($_SESSION['list2'], $data3['cost']);
                                        array_push($_SESSION['list3'], $quty);
                                        array_push($_SESSION['list4'], $data3['code']);

                                        echo "<div class= 'card-header'>
                                                    <i class='fas fa-table me-1'></i>
                                                    Items
                                                </div>

                                                <div class='card-body'>
                                                    <table id='datatablesSimple'>
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Precio</th>
                                                                <th>Cantidad</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            </tr>
                                                        </tfoot>
                                                        <tbody>";

                                        for ($i=0; $i<count($_SESSION['list1']); $i++){
                                            echo "<tr>
                                                <td>".$_SESSION['list1'][$i]."</td>
                                                <td>".$_SESSION['list2'][$i]."</td>
                                                <td>".$_SESSION['list3'][$i]."</td>
                                                </tr>";

                                            $total += $_SESSION['list2'][$i] * $_SESSION['list3'][$i];
                                        }
                                        echo "</tbody>
                                            </table>
                                            </div>";
                                    }
                                }
                                ?>
                            </div>

                            <div class="card mb-4">
                                <h3 class="mt-4"> Total de la Orden: <?php echo $total?></h3>

                                <form action="#" method="post">
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <input type="submit" name="btn-orden" value="Registrar Orden" width="150px" class="btn btn-primary">

                                    <input type="submit" name="btn-cancel" value="Cancelar Orden" width="150px" class="btn btn-primary">
                                </div>
                                </form>
                            </div>

                            <?php
                            if(isset($_POST['btn-orden'])){

                                for ($i=0; $i<count($_SESSION['list1']); $i++){

                                    $totalC += $_SESSION['list2'][$i] * $_SESSION['list3'][$i];

                                    $code = $_SESSION['list4'][$i];

                                    $quantity = $_SESSION['list3'][$i];
                                    
                                    $price = $_SESSION['list2'][$i]; 

                                    $query4 = "INSERT INTO purchaseorder_detail (cod_prod, quantity, cost, id_order) VALUES ('$code','$quantity','$price','$idOrder')"; 
                                    $rs4 = mysqli_query($conn, $query4) or die("Error: " . mysqli_error($conn));
                                }
                                
                                $query5 = "UPDATE purchase_orders set total='$totalC' WHERE id = '$idOrder'"; 
                                $rs5 = mysqli_query($conn, $query5) or die("Error: " . mysqli_error($conn));

                                $_SESSION['list1'] = array ();
                                $_SESSION['list2'] = array ();
                                $_SESSION['list3'] = array ();
                                $_SESSION['list4'] = array ();

                                $message = "Orden de compra registrada con exito";
                                echo "<script>
                                alert('$message');
                                window.location= 'purchaseOrders.php'
                                </script>";

                            }elseif (isset($_POST['btn-cancel'])) {

                                $query6 = "DELETE FROM purchase_orders WHERE id='$idOrder'";
                                $rs6 = mysqli_query($conn, $query6) or die("Error: " . mysqli_error($conn));

                                $_SESSION['list1'] = array ();
                                $_SESSION['list2'] = array ();
                                $_SESSION['list3'] = array ();
                                $_SESSION['list4'] = array ();

                                $message = "Orden de compra cancelada";
                                echo "<script>
                                alert('$message');
                                window.location= 'purchaseOrders.php'
                                </script>";
                            }
                            ?>
                        </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
    </body>
</html>

<?php

} else{
    $message = "usuario o contraseña incorrecta";
    echo "<script>
                alert('$message');
                window.location= '../index.html'
        </script>";
}


?>