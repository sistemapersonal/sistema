<?php include 'template/header.php' ?>


<?php
    if(!isset($_GET['id'])){
        header('Location: principal.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $id = $_GET['id'];

    $sentencia = $bd->prepare("SELECT * FROM movimientos WHERE id = ?;");
    $sentencia->execute([$id]);
    $movimientos = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($movimientos);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarproceso.php">
                    <div class="mb-3">
                        <label class="form-label">Fecha: </label>
                        <input type="date" class="form-control" name="txtfecha" required 
                        value="<?php echo $movimientos->fech; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Detalle: </label>
                        <input type="text" class="form-control" name="txtdetalle" autofocus required
                        value="<?php echo $movimientos->producto; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Importe: </label>
                        <input type="number" class="form-control" name="txtimporte" autofocus required
                        value="<?php echo $movimientos->importe; ?>">
                    </div>

                    <div class="mb-3">
                <label class="form-label">Pago:</label>
                <select class="form-select" aria-label="textpago" name="txtpago" >
                
                <option value="Efectivo">Efectivo</option>
                <option value="Banco">Banco</option>
                
                </div>
                  
                    </select>

                    <div class="d-grid">
                        <input type="hidden" name="id" value="<?php echo $movimientos->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>