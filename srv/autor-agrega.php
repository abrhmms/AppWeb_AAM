<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AUTOR.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $apellido = recuperaTexto("apellido");
 $nacionalidad = recuperaTexto("nacionalidad");

 $nombre = validaNombre($nombre);
 $apellido = validaNombre($apellido);
 $nacionalidad = validaNombre($nacionalidad);

 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: "AUTOR", values: [
  "AUT_NOMBRE" => $nombre,
  "AUT_APELLIDO" => $apellido,
  "AUT_NACIONALIDAD" => $nacionalidad
 ]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/autor.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "apellido" => ["value" => $apellido],
  "nacionalidad" => ["value" => $nacionalidad],
 ]);
});
