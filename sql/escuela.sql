CREATE DATABASE bd_escuela;

Use bd_escuela;

CREATE TABLE tbl_user (
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
    pwd_user char(60) NOT NULL,
    sexo_user set('H','M')
);

CREATE TABLE tbl_roles (
    id_rol int NOT NULL PRIMARY KEY,
    tipo_rol VARCHAR(20) NOT NULL
);

ALTER TABLE tbl_user ADD CONSTRAINT fk_rol_user FOREIGN KEY (id_rol) REFERENCES tbl_roles(id_rol);

INSERT INTO tbl_roles (id_rol, tipo_rol) VALUES
(1, 'Administrador'),
(2, 'Secretaria'),
(3, 'Educador'),
(4, 'Conserje'),
(5, 'Alumno');

INSERT INTO tbl_user (id_user, nom_user, apellido_user, dni_user, fecha_nac_user, id_rol, direccion_user, telf_user, email_cole_user, email_pri_user, pwd_user, sexo_user) VALUES
(1, 'Juan', 'Pérez', '12115682', '1980-05-15', 1, 'Av. Avemaria 123', '673347671', 'adminj23@fje.edu', 'juan.perez@gmail.com', '84596716036af36b4c10170777bfb1db30de96d68f0dacf54914e0c1b5910f8f', 'H'), // Contraseña: Barcelona1234!
(2, 'María', 'Gómez', '24833783', '1990-06-20', 2, 'Calle Falsa 45', '623857785', 'maria.gomez@fje.edu', 'marigomez@gmail.com', 'dcc14f470fde2b2e122980b7df72714684c340496ec21404f240ab3d669f1abf', 'M'),
(3, 'Carlos', 'López', '56577126', '1985-07-25', 3, 'Calle Real 789', '666567892', 'carlos.lopez@fje.edu', 'carloopez@gmail.com', '6a53716a50dc1a2d111494872b0b071c3177649243f177550bdb55d7dbc78a14', 'H'),
(4, 'Ana', 'Martínez', '43661191', '2000-08-30', 4, 'Av. Cristóbal Colón 23', '645574900', 'ana.martínez@fje.edu', 'ana.martinez@gmail.com', '0f7cc1654aaf4f2ee3ec7db068879212157f53277a02db3d69cc86390afa1ee2', 'M'),
(5, 'Luis', 'Fernández', '46623090', '2005-09-10', 5, 'Av. América 14', '65699444', '10234.joan23@fje.edu', 'luisfer@gmail.com', '117e14b163ce24f49c307237e51afdea1cc631936863864ceaa3d61bdaffe921', 'H');


