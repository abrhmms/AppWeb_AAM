<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AUTOR.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 // Intentamos seleccionar el autor con el ID proporcionado
 $modelo = selectFirst(pdo: Bd::pdo(), from: AUTOR, where: [AUT_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "Autor no encontrado.",
   type: "/error/autornoencontrado.html",
   detail: "No se encontró ningún autor con el id $idHtml.",
  );
 }

 // Devolvemos los datos del autor en formato JSON
 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $modelo[AUT_NOMBRE]],
  "apellido" => ["value" => $modelo[AUT_APELLIDO]],
  "nacionalidad" => ["value" => $modelo[AUT_NACIONALIDAD]],
 ]);
});
