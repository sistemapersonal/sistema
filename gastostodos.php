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
$sentencia = $bd -> query("SELECT * FROM gastos");
$gasto = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($movimientos);
?>

<div class="container mt-5">
  <div class="row justify-content-center">
     <div class="col-md-7">
      





         <div class="card">
             <div class="carg-header">
                Lista Gastos Generales
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

     </div>
  </div>


</div>








<?php include 'template/footer.php' ?>