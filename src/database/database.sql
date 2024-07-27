-- Miedo en mi alma version revisada 
-- --------------------------------------------------------
-- Estructura de tabla para la tabla de referencia `ROLES`
--

CREATE TABLE ROLES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rol_nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `GUARDIAS`
--

CREATE TABLE GUARDIAS (
  id INT(11) NOT NULL AUTO_INCREMENT,
  dia_semana VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `TURNOS`
--

CREATE TABLE TURNOS (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  hora_inicio TIME NOT NULL,
  hora_fin TIME NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `PERSONAL`
--

CREATE TABLE PERSONAL (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  apellido_paterno VARCHAR(100) NOT NULL,
  apellido_materno VARCHAR(100) NOT NULL,
  numero_telefono VARCHAR(15) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura para la tabla de entidades usuarios

CREATE TABLE USUARIOS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_personal INT NOT NULL,
  nombre_usuario VARCHAR(100) NOT NULL,
  contrasena VARCHAR(255) NOT NULL,
  FOREIGN KEY (id_personal) REFERENCES PERSONAL(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Roles de los usuarios

CREATE TABLE ROLES_USUARIOS (
  id INT(11) NOT NULL AUTO_INCREMENT, 
  usuario_fk INT NOT NULL,
  rol_fk INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_fk) REFERENCES USUARIOS(id),
  FOREIGN KEY (rol_fk) REFERENCES ROLES(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `ROLES_PERSONAL`

CREATE TABLE ROLES_PERSONAL (
  id INT(11) NOT NULL AUTO_INCREMENT,
  personal_fk INT(11) NOT NULL,
  rol_fk INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (personal_fk) REFERENCES PERSONAL(id),
  FOREIGN KEY (rol_fk) REFERENCES ROLES(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `GUARDIAS_PERSONAL`

CREATE TABLE GUARDIAS_PERSONAL (
  id INT(11) NOT NULL AUTO_INCREMENT,
  personal_fk INT(11) NOT NULL,
  guardia_fk INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (personal_fk) REFERENCES PERSONAL(id),
  FOREIGN KEY (guardia_fk) REFERENCES GUARDIAS(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `TURNOS_PERSONAL`

CREATE TABLE TURNOS_PERSONAL (
  id INT(11) NOT NULL AUTO_INCREMENT,
  personal_fk INT(11) NOT NULL,
  turno_fk INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (personal_fk) REFERENCES PERSONAL(id),
  FOREIGN KEY (turno_fk) REFERENCES TURNOS(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `ACTIVIDADES`

CREATE TABLE ACTIVIDADES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  fecha DATE NOT NULL,
  creador_fk INT NOT NULL,
  encargado_fk INT NOT NULL,
  FOREIGN KEY (creador_fk) REFERENCES USUARIOS(id),
  FOREIGN KEY (encargado_fk) REFERENCES USUARIOS(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de la tabla de entidades asistencias

CREATE TABLE ASISTENCIAS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  personal_fk INT NOT NULL,
  fecha DATE NOT NULL,
  presente TINYINT(1) NOT NULL,
  chequeo_material TINYINT(1) NOT NULL,
  encargado_fk INT NOT NULL,
  FOREIGN KEY (personal_fk) REFERENCES PERSONAL(id),
  FOREIGN KEY (encargado_fk) REFERENCES USUARIOS(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `SANCIONES`

CREATE TABLE SANCIONES (
  id INT AUTO_INCREMENT PRIMARY KEY,
  personal_fk INT NOT NULL,
  creador_fk INT NOT NULL,
  fecha DATE NOT NULL,
  motivo TEXT NOT NULL,
  FOREIGN KEY (personal_fk) REFERENCES PERSONAL(id),
  FOREIGN KEY (creador_fk) REFERENCES USUARIOS(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
