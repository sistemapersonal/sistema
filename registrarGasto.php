<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtfecha"]) || empty($_POST["txtdetalle"]) || empty($_POST["txtimporte"] || empty($_POST["txtpago"]))){
        header('Location: gastos.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    $nombre = $_POST["txtfecha"];
    $edad = $_POST["txtdetalle"];
    $signo = $_POST["txtimporte"];
    $pago = $_POST["txtpago"];
    $sentencia = $bd->prepare("INSERT INTO gastos(fech,gasto,importe,pago) VALUES (?,?,?,?);");
    $resultado = $sentencia->execute([$nombre,$edad,$signo,$pago]);

    if ($resultado === TRUE) {
        header('Location: gastos.php?mensaje=registrado');
    } else {
        header('Location: gastos.php?mensaje=error');
        exit();
    }
    
?>