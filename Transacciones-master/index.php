<?php

require_once 'layout/layout.php';
require_once 'helpers/utilities.php';
require_once 'Estudiantes/estudiante.php';
require_once 'service/IServiceBase.php';
require_once 'Estudiantes/EstudianteServiceCookies.php';

$layout = new Layout(false);
$utilities = new Utilities();
$service = new EstudianteServiceCookies();

$listadoEstudiantes = $service->GetList();

if (!empty($listadoEstudiantes)) {

 if (isset($_GET['carreraId'])) {

  $listadoEstudiantes = $utilities->searchProperty($listadoEstudiantes, 'carreraId', $_GET['carreraId']);
 }
}

?>



<?php $layout->printHeader();?>
<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1>Integrar estudiante</h1>

            <p>
                <a href="Estudiantes/add.php" class="btn btn-primary my-2">Añadir</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-8">
                    <div class="btn-group my-4">
                        <a href="index.php" class="btn bg-secondary text-light">Todos</a>
                        <a href="index.php?carreraId=1" class="btn bg-dark text-light">Redes</a>
                        <a href="index.php?carreraId=2" class="btn bg-dark text-light">Software</a>
                        <a href="index.php?carreraId=3" class="btn bg-dark text-light">Multimedia</a>
                        <a href="index.php?carreraId=4" class="btn bg-dark text-light">Mecatronica</a>
                        <a href="index.php?carreraId=5" class="btn bg-dark text-light">Seguridad Informatica</a>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>

            <div class="row">


                <?php if (empty($listadoEstudiantes)): ?>

                <h2>No hay estudiantes</h2>

                <?php else: ?>

                <?php foreach ($listadoEstudiantes as $estudiante): ?>

                <?php $status = 'Activo';?>
                <?php $darkClass = '';?>

                <?php if ($estudiante->estado == '0'): ?>
                <?php $status = 'Inactivo';?>
                <?php $darkClass = 'bg-dark text-light';?>

                <?php endif;?>


                <div class="col-md-4">

                    <div class="card <?php echo $darkClass; ?> my-2">

                        <?php if ($estudiante->profilePhoto == "" || $estudiante->profilePhoto == null): ?>

                        <img class="bd-placeholder-img card-img-top" src=<?php echo "assets/img/default.png"; ?>
                            width="100%" height="225" aria-label="Placeholder: Thumbnail">

                        <?php else: ?>

                        <img class="bd-placeholder-img card-img-top"
                            src=<?php echo "assets/img/estudiantes/" . $estudiante->profilePhoto ?> width="100%"
                            height="225" aria-label="Placeholder: Thumbnail">

                        <?php endif;?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $estudiante->apellido ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $estudiante->nombre ?></h6>
                            <p class="card-text"><?php echo $estudiante->getCarreraName(); ?></p>
                            <p class="card-text"> <b>Materias favoritas:</b> <?php echo $estudiante->favAsig; ?></p>
                            <p class="card-text"><?php echo $status; ?></p>
                            <a href="Estudiantes/edit.php?id=<?php echo $estudiante->id; ?>"
                                class="btn btn-primary">Editar</a>
                            <a href="Estudiantes/delete.php?id=<?php echo $estudiante->id; ?>"
                                class="btn btn-primary">Eliminar</a>

                        </div>
                    </div>
                </div>


                <?php endforeach;?>
                <?php endif;?>

            </div>



</main>

<?php $layout->printFooter();?>