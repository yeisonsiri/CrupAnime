<?php include("../plantilla/cabeza.php");?>

<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
$txtNacionalidad=(isset($_POST['txtNacionalidad']))?$_POST['txtNacionalidad']:"";
$txtRaza=(isset($_POST['txtRaza']))?$_POST['txtRaza']:"";
$txtOcupacion=(isset($_POST['txtOcupacion']))?$_POST['txtOcupacion']:"";
$txtSexo=(isset($_POST['txtSexo']))?$_POST['txtSexo']:"";
$txtSerie=(isset($_POST['txtSerie']))?$_POST['txtSerie']:"";
$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";
$txtBiografia=(isset($_POST['txtBiografia']))?$_POST['txtBiografia']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


include("../config/bd.php");
switch ($accion) {
    case "Agregar":
        $sentenciasql= $conexion->prepare("INSERT INTO persona (imagen, nombre, apellido, cedula, nacionalidad, 
        raza, ocupacion, sexo, serie, estado, biografia)
        VALUES (:imagen, :nombre, :apellido, :cedula, :nacionalidad, :raza, :ocupacion, :sexo, :serie, :estado, :biografia);");

        $sentenciasql->bindParam(':imagen',$nombreArchivo);
        $sentenciasql->bindParam(':nombre',$txtNombre);

        $sentenciasql->bindParam(':apellido',$txtApellido);
        $sentenciasql->bindParam(':cedula',$txtCedula);
        $sentenciasql->bindParam(':nacionalidad',$txtNacionalidad);
        $sentenciasql->bindParam(':raza',$txtNombre);
        $sentenciasql->bindParam(':ocupacion',$txtRaza);
        $sentenciasql->bindParam(':sexo',$txtSexo);
        $sentenciasql->bindParam(':serie',$txtSerie);
        $sentenciasql->bindParam(':estado',$txtEstado);
        $sentenciasql->bindParam(':biografia',$txtBiografia);
        
       $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_" .$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        
        if ($tmpImagen!="") {

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }
         
        $sentenciasql->execute();
        header("Location:persona.php");
        break;
    case "Editar":
        $sentenciasql=$conexion->prepare("UPDATE persona SET nombre=:nombre, apellido=:apellido, 
        cedula=:cedula, nacionalidad=:nacionalidad, raza=:raza, ocupacion=:ocupacion, sexo=:sexo,
        serie=:serie, estado=:estado, biografia=:biografia WHERE id=:id");

        
        $sentenciasql->bindParam(':nombre',$txtNombre);
        $sentenciasql->bindParam(':apellido',$txtApellido);
        $sentenciasql->bindParam(':cedula',$txtCedula);
        $sentenciasql->bindParam(':nacionalidad',$txtNacionalidad);
        $sentenciasql->bindParam(':raza',$txtNombre);
        $sentenciasql->bindParam(':ocupacion',$txtRaza);
        $sentenciasql->bindParam(':sexo',$txtSexo);
        $sentenciasql->bindParam(':serie',$txtSerie);
        $sentenciasql->bindParam(':estado',$txtEstado);
        $sentenciasql->bindParam(':biografia',$txtBiografia);
        $sentenciasql->bindParam(':id',$txtID);
        $sentenciasql->execute();

        if ($txtImagen!="") {
            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_" .$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            $sentenciasql=$conexion->prepare("SELECT imagen FROM persona WHERE id=:id");
            $sentenciasql->bindParam(':id',$txtID);
            $sentenciasql->execute();
            $persona=$sentenciasql->fetch(PDO::FETCH_LAZY);

            if (isset($persona["imagen"])&&($persona["imagen"]!="imagen.jpg")) {
                if (file_exists("../../img/". $persona["imagen"])) {
    
                    unlink("../../img/".$persona["imagen"]);
                }
            }
            
            $sentenciasql=$conexion->prepare("UPDATE persona SET nombre=:nombre apellido=:apellido 
            cedula=:cedula nacionalidad=:nacionalidad raza=:raza ocupacion=:ocupacion sexo=:sexo
            serie=:serie estado=:estado biografia=:biografia WHERE id=:id");

            $sentenciasql=$conexion->prepare("UPDATE persona SET imagen=:imagen WHERE id=:id");
            $sentenciasql->bindParam(':imagen',$nombreArchivo);
            $sentenciasql->bindParam(':id',$txtID);
            $sentenciasql->execute();
            

        }
header("Location:persona.php");
        break;

    case "Cancelar":
        header("Location:persona.php");
        break;
        
    case "Seleccionar":
 
        $sentenciasql=$conexion->prepare("SELECT * FROM persona WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtID); 
        $sentenciasql->execute();
        $persona=$sentenciasql->fetch(PDO::FETCH_LAZY);

        $txtImagen=$persona['imagen'];
        $txtNombre=$persona['nombre'];
        $txtApellido=$persona['apellido'];
        $txtCedula=$persona['cedula'];
        $txtNacionalidad=$persona['nacionalidad'];
        $txtRaza=$persona['raza'];
        $txtOcupacion=$persona['ocupacion'];
        $txtSexo=$persona['sexo'];
        $txtSerie=$persona['serie'];
        $txtEstado=$persona['estado'];
        $txtBiografia=$persona['biografia'];

        break;

    case "Borrar":
        
        $sentenciasql=$conexion->prepare("SELECT imagen FROM persona WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtID);      
        $sentenciasql->execute();
        $persona=$sentenciasql->fetch(PDO::FETCH_LAZY);

        if (isset($persona["imagen"])&&($persona["imagen"]!="imagen.jpg")) {
            if (file_exists("../../img/". $persona["imagen"])) {
   
                unlink("../../img/".$persona["imagen"]);
            }
        }

        $sentenciasql=$conexion->prepare("DELETE FROM persona WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtID);
        $sentenciasql->execute();
        header("Location:persona.php");
        break;

}

$sentenciasql=$conexion->prepare("SELECT* FROM persona");
$sentenciasql->execute();
$listapersona=$sentenciasql->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    
<div class="card">
    <div class="card-header border-primary">
        Datos Persona
    </div>
    <form method="POST" enctype="multipart/form-data" >
        <div class="btn-group" role="group" aria-label="">
            <button type="Submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
            <button type="Submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Editar" class="btn btn-primary">Editar</button>
            <button type="Submit" name="accion"  <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
    <div class="card-body">

        

        <div class="form-group">
        <label for="txtImagen">Imagen:</label>
        <?php echo $txtImagen; ?> 
        <input type="file"  class="form-control"  name="txtImagen" id="txtImagen"  placeholder="Selecciona una imagen">
        </div>

        <div class="form-group">
        <label for="txtId">ID</label>
        <input type="text" required readonly="" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"  placeholder="ID">
        </div>

        <div class="form-group">
        <label for="txtNombre">Nombre:</label>
        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtApellido">Apellido:</label>
        <input type="text" required class="form-control" value="<?php echo $txtApellido; ?>" name="txtApellido" id="txtApellido"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtCedula">Cedula:</label>
        <input type="text" required class="form-control" value="<?php echo $txtCedula; ?>" name="txtCedula" id="txtCedula"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtNacionalidad">Nacionalidad:</ltxtNacionalidadabel>
        <input type="text" required class="form-control" value="<?php echo $txtNacionalidad; ?>" name="txtNacionalidad" id="txtNacionalidad"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtRaza">Raza:</label>
        <input type="text" required class="form-control" value="<?php echo $txtRaza; ?>" name="txtRaza" id="txtRaza"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtOcupacion">Ocupacion:</label>
        <input type="text" required class="form-control" value="<?php echo $txtOcupacion; ?>" name="txtOcupacion" id="txtOcupacion"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtSexo">Sexo:</label>
        <input type="text" required class="form-control" value="<?php echo $txtSexo; ?>" name="txtSexo" id="txtSexo"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtSerie">Serie a que pertenece:</label>
        <input type="text" required class="form-control" value="<?php echo $txtSerie; ?>" name="txtSerie" id="txtSerie"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtEstado">Estado:</label>
        <input type="text" required class="form-control" value="<?php echo $txtEstado; ?>" name="txtEstado" id="txtEstado"  placeholder="Escrive tu nombre">
        </div>
        <div class="form-group">
        <label for="txtBiografia">Biografia:</label>
        <input type="text" required class="form-control" value="<?php echo $txtBiografia; ?>" name="txtBiografia" id="txtBiografia"  placeholder="Escrive tu nombre">
        </div>

        

        </form>
    </div>
</div>
</div>


<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>Acciones</th>
            <th>Imagen</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Nacionalidad</th>
            <th>Raza</th>
            <th>Ocupacion</th>
            <th>Sexo</th>
            <th>Serie a que pertenece</th>
            <th>Estado</th>
            <th>Biografía</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($listapersona as $persona){ ?>
            <tr>
                <td>
                <form method="post">

                <input type="hidden" name="txtID" id="txtID" value="<?php echo $persona['id'];?>"/>
                <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                </form>
                </td>

                <td>
                <img src="../../img/<?php echo $persona['imagen'];?>" width="75" alt="" srcset="">
                </td>

                <td><?php echo $persona['id']; ?></td>

                <td><?php echo $persona['nombre']; ?></td>

                <td><?php echo $persona['apellido']; ?></td>

                <td><?php echo $persona['cedula']; ?></td>

                <td><?php echo $persona['nacionalidad']; ?></td>

                <td><?php echo $persona['raza']; ?></td>

                <td><?php echo $persona['ocupacion']; ?></td>

                <td><?php echo $persona['sexo']; ?></td>
                
                <td><?php echo $persona['serie']; ?></td>

                <td><?php echo $persona['estado']; ?></td>

                <td><?php echo $persona['biografia']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../plantilla/pie.php");?>