<?php

class Estudiante {

 public $id;
 public $nombre;
 public $apellido;
 public $carreraId;
 public $estado;
 public $favAsig;
 public $profilePhoto;

 private $utilities;

 public function __construct() {

  $this->utilities = new Utilities();
 }

 public function set($data) {
  foreach ($data as $key => $value) {
   $this->{$key} = $value;
  }

 }

 public function initializeData($id, $nombre, $apellido, $carreraId, $estado, $favAsig) {

  $this->id = $id;
  $this->nombre = $nombre;
  $this->apellido = $apellido;
  $this->carreraId = $carreraId;
  $this->estado = $estado;
  $this->favAsig = $favAsig;

 }

 function getCarreraName() {

  if ($this->carreraId != 0 || $this->carreraId != null) {
   return $this->utilities->carreras[$this->carreraId];
  }
 }

}

?>