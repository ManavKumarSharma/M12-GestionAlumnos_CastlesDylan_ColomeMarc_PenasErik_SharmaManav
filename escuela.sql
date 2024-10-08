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
(1, 'Juan', 'Pérez', '12115682', '1980-05-15', 1, 'Av. Avemaria 123', '673347671', 'adminj23@fje.edu', 'juan.perez@gmail.com', 'pass1234', 'H'),
(2, 'María', 'Gómez', '24833783', '1990-06-20', 2, 'Calle Falsa 45', '623857785', 'maria.gomez@fje.edu', 'marigomez@gmail.com', 'pass5678', 'M'),
(3, 'Carlos', 'López', '56577126', '1985-07-25', 3, 'Calle Real 789', '666567892', 'carlos.lopez@fje.edu', 'carloopez@gmail.com', 'pass9101', 'H'),
(4, 'Ana', 'Martínez', '43661191', '2000-08-30', 4, 'Av. Cristóbal Colón 23', '645574900', 'ana.martínez@fje.edu', 'ana.martinez@gmail.com', 'pass1121', 'M'),
(5, 'Luis', 'Fernández', '46623090', '2005-09-10', 5, 'Av. América 14', '65699444', '10234.joan23@fje.edu', 'luisfer@gmail.com', 'pass3141', 'H');

INSERT INTO roles (id_rol, tipo_rol) VALUES
(1, 'Administrador'),
(2, 'Secretaria'),
(3, 'Educador'),
(4, 'Conserje'),
(5, 'Alumno');