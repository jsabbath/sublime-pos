<?php
$base_de_datos = null;
const NOMBRE_BASE_DE_DATOS = "okventa_desde_config";


function crear_base_de_datos()
{
    global $base_de_datos;
    $usuario = "root";
    $contraseña = "";
    try {
        $base_de_datos = new PDO('mysql:host=localhost;', $usuario, $contraseña);
        $base_de_datos->query("create database if not exists " . NOMBRE_BASE_DE_DATOS);
        $base_de_datos = new PDO('mysql:host=localhost;dbname=' . NOMBRE_BASE_DE_DATOS, $usuario, $contraseña);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function crear_tablas()
{
    global $base_de_datos;
    $sentencias = array(
        'CREATE TABLE bajas_inventario
(
  rowid           INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  codigo_producto TEXT                NOT NULL,
  nombre_producto TEXT                NOT NULL,
  numero_piezas   DECIMAL(11, 2)      NOT NULL,
  razon_baja      TEXT                NOT NULL,
  usuario         TINYTEXT            NOT NULL,
  fecha           DATETIME            NOT NULL
);',
        'CREATE TABLE caja
(
  rowid      INT(11) PRIMARY KEY     NOT NULL AUTO_INCREMENT,
  caja_chica DECIMAL(11, 2) UNSIGNED NOT NULL,
  ventas     DECIMAL(11, 2)          NOT NULL,
  gastos     DECIMAL(11, 2)          NOT NULL,
  fecha      DATETIME                NOT NULL,
  no_venta   TEXT                    NOT NULL,
  usuario    TINYTEXT                NOT NULL
);',

        'CREATE TABLE datos_empresa
(
  rowid         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre        TINYTEXT            NOT NULL,
  telefono      TINYTEXT            NOT NULL,
  rfc           TEXT,
  direccion     TEXT,
  colonia       TEXT,
  codigo_postal TINYTEXT
);',

        'CREATE TABLE gastos
(
  rowid           INT(11) PRIMARY KEY     NOT NULL AUTO_INCREMENT,
  importe         DECIMAL(11, 2) UNSIGNED NOT NULL,
  concepto        TEXT                    NOT NULL,
  descripcion     TEXT                    NOT NULL,
  numero_remision TEXT,
  fecha           DATETIME                NOT NULL,
  usuario         TINYTEXT                NOT NULL
);',

        'CREATE TABLE inventario
(
  rowid         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  codigo        TEXT                NOT NULL,
  nombre        TEXT                NOT NULL,
  precio_compra DECIMAL(11, 2)      NOT NULL,
  precio_venta  DECIMAL(11, 2)      NOT NULL,
  utilidad      DECIMAL(11, 2)      NOT NULL,
  existencia    DECIMAL(11, 2)      NOT NULL,
  stock         DECIMAL(11, 2)      NOT NULL,
  familia       TINYTEXT            NOT NULL
);',

        'CREATE TABLE usuarios
(
  rowid           INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre          TINYTEXT            NOT NULL,
  palabra_secreta TINYTEXT            NOT NULL,
  administrador   BIT(1)              NOT NULL
);',


        'CREATE TABLE ventas
(
  numero_venta     INT(11)                NOT NULL,
  codigo_producto  TEXT                   NOT NULL,
  nombre_producto  TEXT                   NOT NULL,
  total            DECIMAL(11, 2)         NOT NULL,
  fecha            DATETIME               NOT NULL,
  numero_productos DECIMAL(11, 2)         NOT NULL,
  usuario          TINYTEXT               NOT NULL,
  familia          TINYTEXT               NOT NULL,
  utilidad         DECIMAL(8, 2) UNSIGNED NOT NULL
);'

    );
    try {
        $sentencia_ayudante = null;
        $resultado = true;
        foreach ($sentencias as $sentencia) {
            $sentencia_ayudante = $base_de_datos->prepare($sentencia);
            $resultado = $sentencia_ayudante->execute();
            $r = $sentencia_ayudante->execute();
        }
        return $resultado;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function crear_usuario_administrador()
{
    require_once dirname(__FILE__) . '/modulos/usuarios/usuarios.php';
    try {
        insertar_usuario("webmaster", "Mexic0T0d0", true);
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function respaldar_archivo_php_ini()
{
    return copy('C:\xampp\php\php.ini', 'C:\xampp\php\backup_php.ini');
}

function eliminar_archivo_php_ini()
{
    return unlink(__DIR__ . '/php.ini');
}

function remplazar_archivo_php_ini()
{
    return copy(__DIR__ . '/php.ini', 'C:\xampp\php\php.ini');
}

function autodestruir()
{
    return unlink(__FILE__);
}

echo "<pre>";
if (crear_base_de_datos()) {
    printf("\nBase de datos %s creada correctamente!", NOMBRE_BASE_DE_DATOS);
    if (crear_tablas()) {
        printf("\nTablas creadas correctamente!");
        if (crear_usuario_administrador()) {
            printf("\nUsuario webmaster creado correctamente!");
            if (respaldar_archivo_php_ini()) {
                printf("\nArchivo php.ini respaldado correctamente!");
                if (remplazar_archivo_php_ini()) {
                    printf("\nArchivo php.ini remplazado correctamente!");
                    if (eliminar_archivo_php_ini()) {
                        printf("\nArchivo php.ini eliminado correctamente!");
                        if (autodestruir()) {
                            printf("\n<<<>Todo correcto. Ahora me autodestruiré la máquina :)<>>>");
                            echo '<script>setTimeout(function(){window.location.href = "./";}, 10000);</script>';
                        } else {
                            printf("\nError en la autodestrucción. Tendrá que ser manualmente");
                        }
                    } else {
                        printf("\nError eliminando php.ini de esta carpeta. Tendrá que ser manualmente.");
                    }
                } else {
                    printf("\nError remplazando archivo php.ini. Tendrá que ser manualmente");
                }
            } else {
                printf("Error copiando el archivo php.ini. Tendrá que ser manualmente.");
            }
        } else {
            printf("\nError creando el usuario webmaster");
        }
    } else {
        printf("\nBase de datos %s creada correctamente!", NOMBRE_BASE_DE_DATOS);
    }
} else {
    printf("\nError creando base de datos %s", NOMBRE_BASE_DE_DATOS);
}
