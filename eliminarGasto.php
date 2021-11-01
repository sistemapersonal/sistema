<?php 
    if(!isset($_GET['codigo'])){
        header('Location: gastos.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("DELETE FROM gastos where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: gastos.php?mensaje=eliminado');
    } else {
        header('Location: gastos.php?mensaje=error');
    }
    
?>