
<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}




$nombre = $_SESSION['nombre'];

?>





<?php
    

    include 'model/conexion.php';
    $id = $_POST['id'];
    $fecha = $_POST['txtfecha'];
    $detalle = $_POST['txtdetalle'];
    $importe = $_POST['txtimporte'];
    $pago = $_POST['txtpago'];

    $sentencia = $bd->prepare("UPDATE gastos SET fech = ?, gasto = ?, importe = ?, pago = ?where id = ?;");
    $resultado = $sentencia->execute([$fecha, $detalle, $importe,$pago, $id]);

    if ($resultado === TRUE) {
        header('Location: gastos.php?mensaje=editado');
    } else {
        header('Location: gastos.php?mensaje=error');
        exit();
    }
    
?>
<?php include 'template/footer.php' ?>