<?php 
    if(!isset($_GET['codigo'])){
        header('Location: principal2.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("DELETE FROM movimientos where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: principal2.php?mensaje=eliminado');
    } else {
        header('Location: principal2.php?mensaje=error');
    }
    
?>