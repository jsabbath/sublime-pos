CREATE TABLE bajas_inventario
(
  rowid           INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  codigo_producto TEXT                NOT NULL,
  nombre_producto TEXT                NOT NULL,
  numero_piezas   DECIMAL(11, 2)      NOT NULL,
  razon_baja      TEXT                NOT NULL,
  usuario         TINYTEXT            NOT NULL,
  fecha           DATETIME            NOT NULL
);
CREATE TABLE caja
(
  rowid      INT(11) PRIMARY KEY     NOT NULL AUTO_INCREMENT,
  caja_chica DECIMAL(11, 2) UNSIGNED NOT NULL,
  ventas     DECIMAL(11, 2)          NOT NULL,
  gastos     DECIMAL(11, 2)          NOT NULL,
  fecha      DATETIME                NOT NULL,
  no_venta   TEXT                    NOT NULL,
  usuario    TINYTEXT                NOT NULL
);
CREATE TABLE datos_empresa
(
  rowid         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre        TINYTEXT            NOT NULL,
  telefono      TINYTEXT            NOT NULL,
  rfc           TEXT,
  direccion     TEXT,
  colonia       TEXT,
  codigo_postal TINYTEXT
);
CREATE TABLE gastos
(
  rowid           INT(11) PRIMARY KEY     NOT NULL AUTO_INCREMENT,
  importe         DECIMAL(11, 2) UNSIGNED NOT NULL,
  concepto        TEXT                    NOT NULL,
  descripcion     TEXT                    NOT NULL,
  numero_remision TEXT,
  fecha           DATETIME                NOT NULL,
  usuario         TINYTEXT                NOT NULL
);
CREATE TABLE inventario
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
);
CREATE TABLE usuarios
(
  rowid           INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre          TINYTEXT            NOT NULL,
  palabra_secreta TINYTEXT            NOT NULL,
  administrador   BIT(1)              NOT NULL
);
CREATE TABLE ventas
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
);