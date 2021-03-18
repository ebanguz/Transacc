<?php

class EstudianteServiceCookies implements IServiceBase {

 private $utilities;
 private $cookieName;

 function __construct() {

  $this->utilities = new Utilities();
  $this->cookieName = "estudiantes";
 }

 public function GetList() {

  $listadoEstudiantes = [];

  if (isset($_COOKIE[$this->cookieName])) {

   $listadoEstudiantesDecode = json_decode($_COOKIE[$this->cookieName], false);

   foreach ($listadoEstudiantesDecode as $elementDecode) {

    $element = new Estudiante();
    $element->set($elementDecode);
    array_push($listadoEstudiantes, $element);
   }

  } else {
   setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(), "/");
  }

  return $listadoEstudiantes;

 }

 public function GetById($id) {

  $listadoEstudiantes = $this->GetList();
  $estudiante = $this->utilities->searchProperty($listadoEstudiantes, 'id', $id)[0];
  var_dump($estudiante);
  return $estudiante;

 }

 public function Add($entity) {

  $listadoEstudiantes = $this->GetList();
  $estudianteId = 1;

  if (!empty($listadoEstudiantes)) {
   $lastEstudiante = $this->utilities->getLastElement($listadoEstudiantes);
   $estudianteId = $lastEstudiante->id + 1;

  }

  $entity->id = $estudianteId;
  $entity->profilePhoto = "";

  if (isset($_FILES['profilePhoto'])) {

   $photoFile = $_FILES['profilePhoto'];

   if ($photoFile['error'] == 4) {

    $entity->profilePhoto = "";

   } else {
    $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
    $type = $photoFile['type'];
    $size = $photoFile['size'];
    $name = $estudianteId . '.' . $typeReplace;
    $tmpName = $photoFile['tmp_name'];

    $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpName, $type, $size);

    if ($success) {
     $entity->profilePhoto = $name;
    }}

  }

  array_push($listadoEstudiantes, $entity);

  setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(), "/");

 }

 public function Update($id, $entity) {

  $element = $this->GetById($id);
  $listadoEstudiantes = $this->GetList();
  $elementIndex = $this->utilities->getElementIndex($listadoEstudiantes, "id", $id);

  if (isset($_FILES['profilePhoto'])) {

   $photoFile = $_FILES['profilePhoto'];

   if ($photoFile == 4) {

    $entity->profilePhoto = $entity->profilePhoto;

   } else {

    $typeReplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
    $type = $_FILES['profilePhoto']['type'];
    $size = $_FILES['profilePhoto']['size'];
    $tmpName = $_FILES['profilePhoto']['tmp_name'];

    $name = $id . "." . $typeReplace;

    $success = $this->utilities->uploadImage("../assets/img/estudiantes/", $name, $tmpName, $type, $size);

    if ($success) {
     $entity->profilePhoto = $name;

    }
   }

  }

  $listadoEstudiantes[$elementIndex] = $entity;
  setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(), "/");
 }

 public function Delete($id) {
  $listadoEstudiantes = $this->GetList();
  $elementIndex = $this->utilities->getElementIndex($listadoEstudiantes, "id", $id);
  unset($listadoEstudiantes[$elementIndex]);
  $listadoEstudiantes = array_values($listadoEstudiantes);
  setcookie($this->cookieName, json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(), "/");
 }
}

?>