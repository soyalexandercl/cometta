-- =====================
-- VEHÍCULOS
-- =====================

CREATE TABLE tipos_vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- =====================
-- GEOGRAFÍA
-- =====================

CREATE TABLE paises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    moneda VARCHAR(50) NOT NULL
);

CREATE TABLE regiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pais INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_pais) REFERENCES paises(id)
);

CREATE TABLE ciudades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_region INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    tarifas DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_region) REFERENCES regiones(id)
);

-- =====================
-- DIRECCIONES
-- =====================

CREATE TABLE direcciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciudad INT NOT NULL,
    codigo_postal VARCHAR(20),
    direccion_original TEXT NOT NULL,
    direccion_normalizada TEXT NOT NULL,
    nivel_confianza INT NOT NULL,
    latitud DECIMAL(10,7),
    longitud DECIMAL(10,7),
    FOREIGN KEY (id_ciudad) REFERENCES ciudades(id)
);

-- =====================
-- USUARIOS
-- =====================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL UNIQUE,
    contrasena VARCHAR(200) NOT NULL,
    fecha_nacimiento DATE
);

CREATE TABLE usuarios_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,

    rol ENUM('sistema','soporte','cliente','negocio','repartidor','flota') NOT NULL,
    estado ENUM('pendiente','habilitado','deshabilitado') NOT NULL DEFAULT 'pendiente',

    score INT NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE (id_usuario, rol),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE usuarios_direcciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_direccion INT NOT NULL,
    observacion TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_direccion) REFERENCES direcciones(id)
);

-- =====================
-- CONSENTIMIENTOS
-- =====================

CREATE TABLE consentimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol ENUM('soporte','cliente','negocio','repartidor','flota'),
    informacion TEXT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios_consentimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_consentimiento INT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_consentimiento) REFERENCES consentimientos(id)
);

-- =====================
-- ENTIDADES
-- =====================

CREATE TABLE entidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado ENUM('pendiente','habilitado','deshabilitado') NOT NULL DEFAULT 'pendiente',
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL UNIQUE,
    score INT NOT NULL DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================
-- FLOTAS
-- =====================

CREATE TABLE flotas (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES entidades(id)
);

CREATE TABLE flotas_direcciones (
    id INT PRIMARY KEY,
    id_direccion INT NOT NULL,
    observacion TEXT,
    FOREIGN KEY (id) REFERENCES flotas(id),
    FOREIGN KEY (id_direccion) REFERENCES direcciones(id)
);

CREATE TABLE flotas_creditos (
    id_flota INT PRIMARY KEY,
    creditos INT NOT NULL DEFAULT 0,
    FOREIGN KEY (id_flota) REFERENCES flotas(id)
);

CREATE TABLE usuarios_flotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_flota INT NOT NULL,
    UNIQUE (id_usuario, id_flota),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_flota) REFERENCES flotas(id)
);

-- =====================
-- REPARTIDORES
-- =====================

CREATE TABLE usuarios_repartidores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_flota INT NOT NULL,
    estado ENUM('pendiente','habilitado','deshabilitado') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (id_usuario, id_flota),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_flota) REFERENCES flotas(id)
);

CREATE TABLE repartidores_vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_tipo INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_tipo) REFERENCES tipos_vehiculos(id)
);

CREATE TABLE repartidores_ubicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    latitud DECIMAL(10,7) NOT NULL,
    longitud DECIMAL(10,7) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- =====================
-- NEGOCIOS
-- =====================

CREATE TABLE negocios (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES entidades(id)
);

CREATE TABLE negocios_direcciones (
    id INT PRIMARY KEY,
    id_direccion INT NOT NULL,
    observacion TEXT,
    FOREIGN KEY (id) REFERENCES negocios(id),
    FOREIGN KEY (id_direccion) REFERENCES direcciones(id)
);

CREATE TABLE negocios_flotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_negocio INT NOT NULL,
    id_flota INT NOT NULL,
    estado ENUM('pendiente','habilitado','deshabilitado') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (id_negocio, id_flota),
    FOREIGN KEY (id_negocio) REFERENCES negocios(id),
    FOREIGN KEY (id_flota) REFERENCES flotas(id)
);

CREATE TABLE usuarios_negocios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_negocio INT NOT NULL,
    UNIQUE (id_usuario, id_negocio),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_negocio) REFERENCES negocios(id)
);

-- =====================
-- CLIENTES
-- =====================

CREATE TABLE usuarios_clientes (
    id INT PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES usuarios(id)
);

-- =====================
-- PEDIDOS
-- =====================

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_negocio INT,
    rol ENUM('cliente','negocio') NOT NULL,
    tipo ENUM('recogida','entrega','personalizado') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_negocio) REFERENCES negocios(id)
);

CREATE TABLE pedidos_programados (
    id INT PRIMARY KEY,
    tipo ENUM('recogida','entrega'),
    fecha_programada TIMESTAMP,
    FOREIGN KEY (id) REFERENCES pedidos(id)
);

CREATE TABLE pedidos_puntos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_direccion INT NOT NULL,
    tipo ENUM('origen','destino','parada'),
    foto BOOLEAN NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    observacion TEXT,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_direccion) REFERENCES direcciones(id)
);

CREATE TABLE pedidos_estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_entidad INT NOT NULL,
    id_usuario INT NOT NULL,
    rol ENUM('sistema','soporte','cliente','negocio','repartidor','flota') NOT NULL,
    estado ENUM('registrado','programado','asignado','aceptado','rechazado','expirado','entregado') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_entidad) REFERENCES entidades(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE pedidos_estados_fotos (
    id INT PRIMARY KEY,
    url TEXT NOT NULL,
    FOREIGN KEY (id) REFERENCES pedidos_estados(id)
);

CREATE TABLE pedidos_repartidores (
    id INT PRIMARY KEY,
    id_usuario INT NOT NULL,
    confirmado BOOLEAN NOT NULL,
    FOREIGN KEY (id) REFERENCES pedidos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- =====================
-- MOVIMIENTOS
-- =====================

CREATE TABLE flotas_movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_flota INT NOT NULL,
    id_pedido INT,
    tipo ENUM('compra','consumo','devolucion') NOT NULL,
    cantidad INT NOT NULL,
    descripcion TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_flota) REFERENCES flotas(id),
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id)
);

-- =====================
-- INCIDENCIAS
-- =====================

CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_entidad INT NOT NULL,
    id_usuario INT NOT NULL,
    informacion TEXT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_entidad) REFERENCES entidades(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);