<?php include 'template/header.php' ?>
<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}




$nombre = $_SESSION['nombre'];

?>
<?php 
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT id, fech, gasto, importe, pago FROM gastos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())");
$gasto = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($movimientos);
?>

<div class="container mt-5">
  <div class="row justify-content-center">
     <div class="col-md-7">
         <!-- inicio alerta -->
         <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->





         <div class="card">
             <div class="carg-header">
                Lista Gastos Mes Actual
             </div>
             <div class="p-4">
                <table class="table align-niddle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">fecha</th>
                            <th scope="col">gasto</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($gasto as $dato){

                        ?>
                        <tr>
                            <td scope="row"><?php echo $dato->id; ?></td>
                            <td><?php echo $dato->fech; ?></td>
                            <td><?php echo $dato->gasto; ?></td>
                            <td><?php echo '$', $dato->importe; ?></td>
                            <td><?php echo $dato->pago; ?></td>
                            <td><a class="text-success" href="editarGasto.php?id=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminarGasto.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                        </tr>
                        <?php
                         }



                         ?>
                        <tr>
                     


                    </tbody>
                </table>
                
                 

             </div>

         </div>

     </div>
     <div class="col-md-4">
         <div class="card">
             <div class="card-header">
                 Ingresar Gasto

             </div>
             <form class="p-4" method="POST" action="registrarGasto.php">
                <div class="mb-3">
                    <label class="form-label">Fecha:</label>
                    <input type="date" class="form-control" name="txtfecha" autofocus required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Gasto:</label>
                    <input type="text" class="form-control" name="txtdetalle" autofocus required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Importe:</label>
                    <input type="number" class="form-control" name="txtimporte" autofocus required>

                    <div class="mb-3">
                <label class="form-label">Pago:</label>
                <select class="form-select" aria-label="textpago" name="txtpago" >
                
                <option value="Efectivo">Efectivo</option>
                <option value="Banco">Banco</option>
                
                
                </select>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="oculto" value="1">
                    <input type="submit" class="btn btn-primary" value="Registrar">

             </form>

         </div>

     </div>
  </div>


</div>








<?php include 'template/footer.php' ?>