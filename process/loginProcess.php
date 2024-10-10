<?php
session_start();

include ("./connection/connection.php");

echo $_SESSION['data']['email'];
$_SESSION["data"][$campo];


if(isset($_SESSION["data"])){
    $valoresBBDD = [];
    foreach ($_SESSION["data"] as $campo => $valor) {
        // $valoresBBDD[$campo] = mysqli_real_escape_string($mysqli, $valor);
        echo $valoresBBDD[$campo];
        echo $valor;
    }
}



$_SESSION["data"];

echo $_SESSION["data"]["email"];








?>