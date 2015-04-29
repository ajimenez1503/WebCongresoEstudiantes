CREATE TABLE Actividad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT NOT NULL,
    fecha DATE,
    hora  TEXT,
    foto TEXT NOT NULL,
    precio INT NOT NULL,
    descripcion TEXT NOT NULL
)
CREATE TABLE Cuota(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo TEXT NOT NULL,
    importe INT NOT NULL
)
CREATE TABLE Usuario(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT NOT NULL,
    contraseña TEXT NOT NULL,
    email TEXT NOT NULL,
    rol TEXT NOT NULL
)
CREATE TABLE Participante(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT NOT NULL,
    apellido TEXT NOT NULL
)
CREATE TABLE Participante_usuario(
    id_participante INT UNSIGNED,
    id_usuario INT UNSIGNED,
    FOREIGN KEY (id_participante) REFERENCES Participantes(id),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    CONSTRAINT id PRIMARY KEY (id_participante,id_usuario)
)
