<?php include 'template/header.php' ?>
<?php

session_start();
if(!isset($_SESSION['id'])){
    header("Location:  index.php");
}






?>

<?php 
include_once "model/conexion.php";
//movimientos tabla
$sentencia = $bd -> query("SELECT id,fech,producto, importe, pago FROM movimientos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())");
$movimientos = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($movimientos);
?>


<?php 
//Facturado Limpio mes actual
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT (SELECT SUM(importe) FROM movimientos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())) - (SELECT SUM(importe)FROM gastos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())) AS Total_Limpio ");
$total = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>
<?php 
//Estado Banco
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT (SELECT SUM(importe) FROM movimientos WHERE pago = 'Banco') - (SELECT SUM(importe)FROM gastos WHERE pago = 'Banco') AS Total_Banco");
$total2 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total2);
//echo " <h4> "." Total " . " </h2> ";  

?>
<?php 
//Facturado Ano
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT  DATE_FORMAT(fech, '%Y') AS Fecha, SUM(importe) AS Total FROM movimientos  GROUP BY DATE_FORMAT(fech, '%Y')");
$total3 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total3);
?>
<?php 
//Gastos mes actual
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT (SELECT SUM(importe) FROM gastos WHERE MONTH(fech) = MONTH(CURRENT_DATE())AND YEAR(fech) = YEAR(CURRENT_DATE())) AS Total_Gasto");
$total4 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>
<?php 
//Facturado Limpio ano actual
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT (SELECT SUM(importe) FROM movimientos WHERE YEAR(fech) = YEAR(CURRENT_DATE()))  - (SELECT SUM(importe)FROM gastos WHERE YEAR(fech) = YEAR(CURRENT_DATE())) AS Total_Limpio  GROUP BY YEAR(CURRENT_DATE())");
$total5 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>
<?php 
//Facturado por mes Bruto
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT  DATE_FORMAT(fech, '%M%Y') AS Fecha, SUM(importe) AS Total FROM movimientos  GROUP BY DATE_FORMAT(fech, '%M%Y')");
$total6 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>
<?php 
//Facturado Ano pasado
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT YEAR(NOW())-1 AS Fecha,(SELECT SUM(importe) FROM movimientos WHERE YEAR(fech) = YEAR(NOW())-1)  - (SELECT SUM(importe)FROM gastos WHERE YEAR(fech) = YEAR(NOW())-1) AS Total_Limpio");
$total7 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total3);
?>
<?php 
//Facturado Limpio ano actual
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT YEAR(NOW()) AS Fecha,(SELECT SUM(importe) FROM movimientos WHERE YEAR(fech) = YEAR(NOW()))  - (SELECT SUM(importe)FROM gastos WHERE YEAR(fech) = YEAR(NOW())-1) AS Total_Limpio");
$total8 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total3);
?>
<?php 
//Gasto por mes Bruto
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT  DATE_FORMAT(fech, '%M%Y') AS Fecha, SUM(importe) AS Total FROM gastos  GROUP BY DATE_FORMAT(fech, '%M%Y')");
$total9 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>
<?php 
//Facturado mes pasado limpio
include_once "model/conexion.php";
$sentencia = $bd -> query("SELECT (SELECT SUM(importe) FROM movimientos WHERE MONTH(fech) = MONTH(CURRENT_DATE())-1) - (SELECT SUM(importe)FROM gastos WHERE MONTH(fech) = MONTH(CURRENT_DATE())-1) AS Total_Limpio ");
$total10 = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($total);
?>







<div>

<div class="container mt-5">
  <div class="row justify-content-center">
     <div class="col-md-7">

         
                              
         
                         
            <div class="row">
  <div class="col-sm-6">
  <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Facturado Limpio</h5>
        
        <?php foreach($total as $dato2){ ?>
            <th><?php echo '$', $dato2->Total_Limpio; ?></th>
        
      </div>
      <?php
                         }
                         ?>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Estado Banco</h5>
        <?php foreach($total2 as $dato){ ?>
         <th><?php echo '$', $dato->Total_Banco; ?></th>
                            <th>
      </div>
      <?php
                         }
                         ?>
      <tr>
                           
    </div>
  </div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Gastos Mes Actual</h5>
        <?php foreach($total4 as $dato){ ?>
         <th><?php echo '$', $dato->Total_Gasto; ?></th>
                            <th>
            <?php
                         }
                         ?>
      </div>
      </thead>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Fac Limpio Anual </h5>
        <?php foreach($total5 as $dato){ ?>
         <th>
             
         <?php echo '$', $dato->Total_Limpio; ?></th>
                           
         <th>
      </div>
      <tr>
      <?php
                         }
                         ?>        
    </div>
  </div>
  <div class="row">
  <div class="col-sm-6">
  <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Fac Limpio Mes anterior</h5>
        
        <?php foreach($total10 as $dato){ ?>
            <th><?php echo '$', $dato->Total_Limpio; ?></th>
        
      </div>
      <?php
                         }
                         ?>
    </div>
  </div>
                        

                      
                        
</div>                              
<div class="card">
             <div class="carg-header">
             Facturado Anual
             </div>
             <div class="p-4">
                <table class="table align-niddle">
                    <thead>
                        <tr>
                            
                            <th scope="col">fecha</th>
                           
                            <th scope="col">Importe</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($total7 as $dato7){

                        ?>
                      
                    
                        <tr>
                           
                            <td><?php echo $dato7->Fecha; ?></td>
                            <td><?php echo '$', $dato7->Total_Limpio; ?></td>
                            
                            
                            
                        </tr>
                        

                        <?php
                         }
                         ?>
                         

                        </table>    
                        <div>

                        </div> 
     <table>
                       
        <div class="card">
             <div class="carg-header">
             Facturado Mensual Bruto
         
             <div class="p-4">
                <table class="table align-niddle">
                    <thead>
                        <tr>
                            
                            <th scope="col">fecha</th>
                           
                            <th scope="col">Importe</th>
                          
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($total6 as $dato6){

                        ?>
                      
                    
                        <tr>
                           
                            <td><?php echo $dato6->Fecha; ?></td>
                            <td><?php echo '$', $dato6->Total; ?></td>
                            
                            
                        </tr>
                        

                        <?php
                         }
                         ?>
                        

                        </table>                







<?php include 'template/footer.php' ?>