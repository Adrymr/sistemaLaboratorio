<?php
ob_start();
include_once('connection.php');

$longPass = 6;
$key = substr( md5(microtime()), 1, $longPass);
$password = $key;

if(isset($_POST['btn-pass']) && isset($_POST['inputEmail']) && !empty($_POST['inputEmail'])){

    $email = trim($_POST['inputEmail']);
    $query = "SELECT * FROM users WHERE emailUser = '$email'";
    $rs = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($rs);
    $data = mysqli_fetch_array($rs);

    if ($rows > 0){
        $query2 = "UPDATE users SET passUser = '$password' WHERE emailUser = '$email'";
        $result = mysqli_query($conn, $query2);

        $to = $email; 
        $subject = "Recuperación de Contraseña | Laboratorio CleanUp";
        $body = "<!DOCTYPE html>
        <html lang='es'>
        <head>
        <title>Recuperar Clave de Usuario</title>";

        $body .= "<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #888;
            background-color:rgba(230, 225, 225, 0.5);
            line-height: 30px;
            text-align: center;
        }
        .contenedor{
            width: 80%;
            min-height:auto;
            text-align: center;
            margin: 0 auto;
            background: #ececec;
            border-top: 3px solid #E64A19;
        }
        .btnlink{
            padding:15px 30px;
            text-align:center;
            background-color:#cecece;
            color: crimson !important;
            font-weight: 600;
            text-decoration: blue;
        }
        .btnlink:hover{
            color: #fff !important;
        }
        .imgBanner{
            width:100%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            padding:0px;
        }
        .misection{
            color: #34495e;
            margin: 4% 10% 2%;
            text-align: center;
            font-family: sans-serif;
        }
        .mt-5{
            margin-top:50px;
        }
        .mb-5{
            margin-bottom:50px;
        }
        </style>"; 

        $body .= "</head>
        <body>
            <div class='contenedor'>
            <table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>
            <tr>
                <td style='padding: 0'>
                    <img style='padding: 0; display: block' src='https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/banner.jpg' width= '100%'>
                </td>
            </tr>
            <tr>
                <td style= 'background-color: #ffffff;'>
                    <div class='misection'>
                        <h2 style='color: red; margin: 0 0 7px;'>Hola,".$data['nameUser']."</h2>
                        <p style='margin: 2px; font-size: 18px'>Te hemos creado una nueva clave temporal para que puedas iniciar sesión, la clave temporal es: <strong>".$password."</strong> Recuerda actualizar tu contraseña luego</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <a href='http://localhost/sistemaLaboratorio/index.html' 
                        class='btnlink'>Iniciar Sesión </a>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <img style='padding: 0;' src='https://permutasalcuadrado.com/Como-recuperar-clave-de-usuario-usando-PHP-y-MYSQL/assets/images/welltow.gif' width='50%'>
                        <p>&nbsp;</p>
                    </div>
                </td>
            </tr>
        </table>"; 

        $body .= "</div>
        </body>
        </html>";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: Laboratorio CleanUp | Soporte Tecnico \r\n"; 
        $headers .= "Reply-To: "; 
        $headers .= "Return-path:"; 
        $headers .= "Cc:"; 
        $headers .= "Bcc:"; 
        (mail($to,$subject,$body,$headers));
        echo "se envio el correo";
    }else{
        header('Location: ../index.html');
    }
}

ob_end_flush();
?>