<?php

class Bd
{
  private static ?PDO $pdo = null;

  static function pdo(): PDO
  {
    if (self::$pdo === null) {

      self::$pdo = new PDO(
        // cadena de conexión
        "sqlite:srvbd.db",
        // usuario
        null,
        // contraseña
        null,
        // Opciones: pdos no persistentes y lanza excepciones.
        [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );

      self::$pdo->exec(
        "CREATE TABLE IF NOT EXISTS AUTOR (
      AUT_ID INTEGER,
      AUT_NOMBRE TEXT NOT NULL,
      AUT_APELLIDO TEXT NOT NULL,
      AUT_NACIONALIDAD TEXT NOT NULL,
      CONSTRAINT AUT_PK 
       PRIMARY KEY(AUT_ID),
      CONSTRAINT AUT_NOM_UNQ 
       UNIQUE(AUT_NOMBRE, AUT_APELLIDO),
      CONSTRAINT AUT_NAC_NV 
       CHECK(LENGTH(AUT_NACIONALIDAD) > 0)
     )"
      );
    }

    return self::$pdo;
  }
}
