<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/IServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$layout = new Layout(true);
$service = new EstudianteServiceCookies();
$utilities = new Utilities();

if (isset($_GET['id'])) {

 $estudianteId = $_GET['id'];

 $element = $service->GetById($estudianteId);

 if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_POST['favAsig'])) {

  if (isset($_POST['estado']) && $_POST['estado'] == '1') {
   $estado = '1';
  } else {
   $estado = '0';
  }
  $updateEstudiante = new Estudiante();

  $updateEstudiante->initializeData($estudianteId, $_POST['nombre'], $_POST['apellido'], $_POST['carrera'], $estado, $_POST['favAsig']);

  $service->Update($estudianteId, $updateEstudiante);
  header("Location: ../index.php");
  exit();
 }
} else {

 header("Location: ../index.php");
 exit();
}

?>




<?php $layout->printHeader();?>
<main role="main">

    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-8">
            <div class="container">
                <div class="card my-5">
                    <div class="card-header">
                        Añadir Estudiante
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="edit.php?id=<?php echo $element->id ?>"
                            method="POST">
                            <div class="form-group">
                                <label for="name">Nombre del Estudiante:</label>
                                <input type="text" value="<?php echo $element->nombre ?>" class="form-control"
                                    id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Apellido del Estudiante:</label>
                                <input type="text" value="<?php echo $element->apellido ?>" class="form-control"
                                    id="apellido" name="apellido">
                            </div>
                            <div class=" form-group">
                                <label for="carrera">Carrera:</label>
                                <select class="form-control" id="carrera" name="carrera">


                                    <?php foreach ($utilities->carreras as $id => $text): ?>

                                    <?php if ($id == $element->carreraId): ?>

                                    <option selected value="<?php echo $id ?>"> <?php echo $text; ?></option>

                                    <?php else: ?>

                                    <option value="<?php echo $id ?>"> <?php echo $text; ?></option>

                                    <?php endif;?>
                                    <?php endforeach;?>

                                </select>
                            </div>

                            <label for="fav">Materias favoritas:</label>
                            <input type="text" value="<?php echo $element->favAsig ?>" class="form-control" id="fav"
                                name="favAsig">

                            <div class="form-group">
                                <label for="photo">Foto de perfil:</label>
                                <input type="file" class="form-control" id="photo" name="profilePhoto">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="estado" name="estado" value="1">
                                <label class="form-check-label" for="estado">Activo</label>
                            </div>

                            <a href="../index.php" class="align-self-end">Volver atrás</a>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md"></div>
    </div>

</main>

<?php $layout->printFooter();?>