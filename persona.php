<?php include("plantilla/cabeza.php" ); ?>

<?php 
include("administrador/config/bd.php");

$sentenciasql=$conexion->prepare("SELECT* FROM persona");
$sentenciasql->execute();
$listapersona=$sentenciasql->fetchAll(PDO::FETCH_ASSOC);
?>
 <?php foreach($listapersona as $persona) { ?>

<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="./img/<?php echo $persona['imagen']; ?>" alt="">
    <div class="card-body">
        <h5  class="card-title"><?php echo $persona['nombre']; ?></h5>
        <a name="" id="" class="btn btn-primary" href="#" role="button">Ver más </a>
    </div>
</div>
</div>
<?php } ?>



<?php include("plantilla/pie.php" ); ?>