
<?php
    

    include 'model/conexion.php';
    $id = $_POST['id'];
    $fecha = $_POST['txtfecha'];
    $detalle = $_POST['txtdetalle'];
    $importe = $_POST['txtimporte'];
    $pago = $_POST['txtpago'];

    $sentencia = $bd->prepare("UPDATE movimientos SET fech = ?, producto = ?, importe = ?, pago = ? where id = ?;");
    $resultado = $sentencia->execute([$fecha, $detalle, $importe, $pago, $id]);

    if ($resultado === TRUE) {
        header('Location: principal2.php?mensaje=editado');
    } else {
        header('Location: principal.php?mensaje=error');
        exit();
    }
    
?>
