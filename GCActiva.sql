/*******************************************************************************
NO MODIFIQUE ESTE FICHERO, NO TENDRÁ EFECTO
********************************************************************************/
/*******************************************************************************
GCActiva
Description: Creates and populates the DB.
DB Server: Sqlite
Author: Juan Carlos Rodriguez-del-Pino, Daniel Gonzalez Dominguez
License: GPL3
********************************************************************************/
PRAGMA foreign_keys = ON;
/*******************************************************************************
   Drop Tables
********************************************************************************/
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS actividades;
DROP TABLE IF EXISTS empresas;
DROP TABLE IF EXISTS tickets;

/*******************************************************************************
   Create Tables
********************************************************************************/
CREATE TABLE usuarios
(
    id INTEGER PRIMARY KEY,
    cuenta NVARCHAR(20) NOT NULL,
    clave NVARCHAR(32) NOT NULL,
    nombre NVARCHAR(200) DEFAULT '',
    tipo INTEGER DEFAULT 2,
    email NVARCHAR(200) DEFAULT '',
    poblacion NVARCHAR(200) DEFAULT '',
    direccion NVARCHAR(200) DEFAULT '',
    telefono NVARCHAR(200) DEFAULT ''
);
/*
tipo:
    1 administrador
    2 empresa
    3 cliente
*/
CREATE UNIQUE INDEX IF NOT EXISTS indexusuario on usuarios (cuenta);

CREATE TABLE actividades
(
    id INTEGER PRIMARY KEY,
    idempresa INTEGER NOT NULL,
    nombre NVARCHAR(32) NOT NULL,
    tipo NVARCHAR(16)  NOT NULL,
    descripcion NVARCHAR(1024) NOT NULL,
    precio REAL NOT NULL,
    aforo INTEGER,
    inicio INTEGER,
    duracion INTEGER,
    imagen BLOB,
    FOREIGN KEY (idempresa) REFERENCES usuarios (id)
    		ON DELETE CASCADE
);

CREATE TABLE empresas
(
    idempresa INTEGER UNIQUE,
    nombre NVARCHAR(32) NOT NULL,
    descripcion NVARCHAR(1024) NOT NULL,
    contacto NVARCHAR(256),
    logo BLOB,
    FOREIGN KEY (idempresa) REFERENCES usuarios (id)
    		ON DELETE CASCADE
);

CREATE TABLE tickets
(
    id INTEGER PRIMARY KEY,
    idcliente INTEGER NOT NULL,
    idactividad INTEGER NOT NULL,
    precio REAL NOT NULL,
    unidades REAL NOT NULL,
    FOREIGN KEY (idcliente) REFERENCES usuarios (id)
		ON DELETE CASCADE,
    FOREIGN KEY (idactividad) REFERENCES actividades (id)
		ON DELETE CASCADE
);

/*******************************************************************************
   Populate Tables
********************************************************************************/
INSERT INTO usuarios (cuenta, clave, nombre, tipo)
     VALUES ('adm', 'c4ca4238a0b923820dcc509a6f75849b', 'Elma Ndamás', 1);
INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono)
     VALUES ('em1', 'c81e728d9d4c2f636f067f89cc14862c', 'Auditorio S.A.', 2, 'aditoriosa@gmeil.com','Las Palmas de G.C.', 'C/Carretera del Rincón Nº 61', '928111111');
INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono)
     VALUES ('em2', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 'Senderimo en GC', 2, 'senderismogc@gmeil.com', 'Telde', 'C/San Greorio Nº 44', '928123456');
INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono)
     VALUES ('cl1', 'a87ff679a2f3e71d9181a67b7542122c', 'Bus Cogangas', 3, 'busc99@gmeil.com', 'Las Palmas de Gran Canaria', 'Avd/Juan XXV Nº 13', '928454545');
INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono)
     VALUES ('cl2', 'e4da3b7fbbce2345d7772b0674a318d5', 'Comp Rador', 3, 'comp@gmeil.com', 'Santa Brigida', 'C/Principal', '928252525');
INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono)
     VALUES ('cl3', '1679091c5a880faf6fb5e6087eb1b2dc', 'Sol Omiro', 3, 'omiro@gmeil.com', 'Gáldar', 'C/Larga', '928888888');

INSERT INTO empresas (idempresa, nombre, descripcion, contacto, logo)
        VALUES (2, 'Auditorio S.A.', 'Empresa que gestiona y promueve espectáculos musicales y teatrales en la ciudad de Las Palmas de Gran Canaria desde el año 1988',
"Las Palmas de Gran Canaria
Oficinas en Av/Mesa y López Nº 3118
Teléfono: 928222222
CIF: 1111111111",
                readfile('imagenes/auditorio.png'));
INSERT INTO empresas (idempresa, nombre, descripcion, contacto, logo)
        VALUES (3,
'Senderimo en GC',
'Asociación Deportiva que organiza rutas de senderismo en la isla de Gran Canaria',
"Telde
C/San Greorio Nº 44
Teléfono de contato 611555555",
                readfile('imagenes/senderismogc.png'));

INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (2, 'Opera Rigolleto', 'Música', 'Auditorio. Riggolleto la clásica ópera en tres actos de Giuseppe Verdi',
                33.5, 355, 1587164400, 10800, readfile('imagenes/rigoletto.jpg'));
INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (2, 'Los miserables', 'Musical', 'Teatro Pérez Galdos. Adaptación musical de la famosa novela de Víctor Hugo',
                28, 325, 1587862800, 900, readfile('imagenes/losmiserables.jpg'));
INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (2, 'Juanes', 'Música', 'Auditorio. Concierto del conocido músico colombiano Juanes',
                26.5, 355, 1588289400, 7200, readfile('imagenes/juanes.jpg'));
INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (3, 'Camino de La Rama', 'Senderismo', 'Descenso desde Tamadaba a San Pedro siguiendo el camino de La Rama. Dificultad media/alta',
                15, 45, 1587209400, 13800, readfile('imagenes/tamadaba.jpg'));
INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (3, 'Caldera de Bandama', 'Senderismo', 'Descenso a la Caldera de Bandama. Paseo con un recorrido volcánico y etnográfico. Dificultad baja',
                12, 20, 1587906000, 10000, readfile('imagenes/bandama.jpg'));
INSERT INTO actividades (idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion, imagen)
        VALUES (3, 'Guayadeque-Temisas', 'Senderismo', 'Guayadeque-Observatorio Astronómico de Temisas. Dificultad media',
                18.5, 12, 1588285800, 12000, readfile('imagenes/observatorio.jpg'));

INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (4, 1, 33.5, 3);
INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (4, 5, 12, 2);
INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (5, 1, 33.5, 1);
INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (5, 3, 26.5, 1);
INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (5, 5, 12, 1);
INSERT INTO tickets (idcliente, idactividad, precio, unidades)
        VALUES (5, 6, 18.5, 2);

