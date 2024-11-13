<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AUTOR.php";

ejecutaServicio(function () {

 // Seleccionamos todos los registros de la tabla AUTOR, ordenados por nombre
 $lista = select(pdo: Bd::pdo(), from: AUTOR, orderBy: AUT_NOMBRE);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[AUT_ID]);
  $id = htmlentities($encodeId);
  $nombre = htmlentities($modelo[AUT_NOMBRE]);
  $apellido = htmlentities($modelo[AUT_APELLIDO]);

  $render .=
   "<li>
     <p>
      <a href='modifica.html?id=$id'>$nombre $apellido</a>
     </p>
    </li>";
 }

 // Devolvemos la lista renderizada en formato JSON
 devuelveJson(["lista" => ["innerHTML" => $render]]);
});
