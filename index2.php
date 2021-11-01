<?php include 'template/header.php' ?>
   
<?php 
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT id,fech,producto, importe FROM movimientos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())");
$movimientos = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($movimientos);
?>
<?php 
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT SUM(importe) FROM movimientos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())");
$total = $sentencia->fetchAll(PDO::FETCH_OBJ);
print_r($total);
?>



<div class="container mt-5">
  <div class="row justify-content-center">
     <div class="col-md-7">

         <!-- inicio alerta -->
         
            <!-- fin alerta -->

            


         <div class="card">
             <div class="carg-header">
                Lista Movimientos Mes Actual
             </div>
             
             <div class="p-4">
            
                <table class="table align-niddle">
                    <thead>
                   
                   
                        <tr>
                            
                            <th scope="col">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($movimientos as $dato){

                        ?>
                    
                        <tr>
                            <td scope="row"><?php echo $dato->id; ?></td>
                            <td><?php echo $dato->fech; ?></td>
                            <td><?php echo $dato->producto; ?></td>
                            <td><?php echo '$', $dato->importe; ?></td>
                            
                        </tr>
                        

                        <?php
                         }
                         ?>


                        </table>                     

                    </tbody>
                
                 

             </div>

         </div>

     </div>
     <div class="col-md-4">
         <div class="card">
             <div class="card-header">
                 Ingresar datos

             </div>
             <form class="p-4" method="POST" action="registrar.php">
                <div class="mb-3">
                    <label class="form-label">Fecha:</label>
                    <input type="date" class="form-control" name="txtfecha" autofocus required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Detalle:</label>
                    <input type="text" class="form-control" name="txtdetalle" autofocus required>

                </div>
                <div class="mb-3">
                    <label class="form-label">Importe:</label>
                    <input type="number" class="form-control" name="txtimporte" autofocus required>

                </div>
                <div class="d-grid">
                    <input type="hidden" name="oculto" value="1">
                    <input type="submit" class="btn btn-primary" value="Registrar">

             </form>
             <tr>

         </div>
       
     </div>
  </div>


</div>








<?php include 'template/footer.php' ?>