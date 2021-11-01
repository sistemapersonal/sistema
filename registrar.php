<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtfecha"]) || empty($_POST["txtdetalle"]) || empty($_POST["txtimporte"] || empty($_POST["txtpago"]))){
        header('Location: principal2.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    $nombre = $_POST["txtfecha"];
    $edad = $_POST["txtdetalle"];
    $signo = $_POST["txtimporte"];
    $pago = $_POST["txtpago"];
    
    $sentencia = $bd->prepare("INSERT INTO movimientos(fech,producto,importe,pago) VALUES (?,?,?,?);");
    $resultado = $sentencia->execute([$nombre,$edad,$signo,$pago]);

    if ($resultado === TRUE) {
        header('Location: principal2.php?mensaje=registrado');
    } else {
        header('Location: principal2.php?mensaje=error');
        exit();
    }
    
?>