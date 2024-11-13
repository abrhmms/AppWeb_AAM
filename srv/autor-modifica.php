<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AUTOR.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");
 $apellido = recuperaTexto("apellido");
 $nacionalidad = recuperaTexto("nacionalidad");

 // Validamos los textos
 $nombre = validaNombre($nombre);
 $apellido = validaNombre($apellido);
 $nacionalidad = validaNombre($nacionalidad);

 // Actualizamos los datos en la tabla AUTOR
 update(
  pdo: Bd::pdo(),
  table: AUTOR,
  set: [
   AUT_NOMBRE => $nombre,
   AUT_APELLIDO => $apellido,
   AUT_NACIONALIDAD => $nacionalidad
  ],
  where: [AUT_ID => $id]
 );

 // Devolvemos los datos actualizados en formato JSON
 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "apellido" => ["value" => $apellido],
  "nacionalidad" => ["value" => $nacionalidad],
 ]);
});
