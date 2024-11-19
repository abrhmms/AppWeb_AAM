<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaNacionalidad(false|string $nacionalidad)
{

 if ($nacionalidad === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta nacionalidad.",
   type: "/error/faltanacionalidad.html",
   detail: "La solicitud no tiene el valor de nacionalidad."
  );

 $trimNacionalidad = trim($nacionalidad);

 if ($trimNacionalidad === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Nacionalidad en blanco.",
   type: "/error/nacionalidadenblanco.html",
   detail: "Pon texto en el campo nacionalidad.",
  );

 return $trimNacionalidad;
}
