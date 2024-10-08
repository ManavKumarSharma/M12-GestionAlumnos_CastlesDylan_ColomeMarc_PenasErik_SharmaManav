CREATE DATABASE escuela;

Use escuela;

CREATE TABLE user (
    id_user int NOT NULL PRIMARY KEY,
    nom_user varchar(25) NOT NULL,
    apellido_user varchar(40) NOT NULL,
    dni_user char(8) NOT NULL,
    fecha_nac_user date NOT NULL,
    id_rol int NOT NULL,
    direccion_user varchar(40),
    telf_user char(9) NOT NULL,
    email_cole_user varchar(40) NOT NULL,
    email_pri_user varchar(40) NOT NULL,
    pwd_user char(12) NOT NULL,
    sexo_user set('H','M')
);

CREATE TABLE roles (
    id_rol int NOT NULL PRIMARY KEY,
    tipo_rol VARCHAR(20)
);

ALTER TABLE user ADD CONSTRAINT fk_rol_user FOREIGN KEY (id_rol) REFERENCES roles(id_rol);

INSERT INTO user VALUES 
INSERT INTO user (id_user, nom_user, apellido_user, dni_user, fecha_nac_user, id_rol, direccion_user, telf_user, email_cole_user, email_pri_user, pwd_user, sexo_user) VALUES
(1, 'Juan', 'Pérez', '12345678', '1980-05-15', 1, 'Av. Siempre Viva 123', '912345678', 'juan@colegio.com', 'juan.perez@gmail.com', 'pass1234', 'H'),
(2, 'María', 'Gómez', '23456789', '1990-06-20', 2, 'Calle Falsa 456', '923456789', 'maria@colegio.com', 'maria.gomez@gmail.com', 'pass5678', 'M'),
(3, 'Carlos', 'López', '34567890', '1985-07-25', 3, 'Calle Real 789', '934567890', 'carlos@colegio.com', 'carlos.lopez@gmail.com', 'pass9101', 'H'),
(4, 'Ana', 'Martínez', '45678901', '2000-08-30', 4, 'Calle del Sol 321', '945678901', 'ana@colegio.com', 'ana.martinez@gmail.com', 'pass1121', 'M'),
(5, 'Luis', 'Fernández', '56789012', '2005-09-10', 5, 'Calle Luna 654', '956789012', 'luis@colegio.com', 'luis.fernandez@gmail.com', 'pass3141', 'H');

INSERT INTO roles (id_rol, tipo_rol) VALUES
(1, 'Administrador'),
(2, 'Secretaria'),
(3, 'Educador'),
(4, 'Conserje'),
(5, 'Alumno');