<?php

require_once '../helpers/utilities.php';
require_once 'estudiante.php';
require_once '../service/IServiceBase.php';
require_once 'EstudianteServiceCookies.php';

$service = new EstudianteServiceCookies();

$isContainedId = isset($_GET['id']);

if ($isContainedId) {

 $estudianteId = $_GET['id'];

 $service->Delete($estudianteId);
}
header('Location: ../index.php');

exit();
?>