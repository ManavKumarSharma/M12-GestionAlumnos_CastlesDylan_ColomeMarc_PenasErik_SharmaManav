
-- CREACION BBDD

    CREATE DATABASE bd_escuela;

    Use bd_escuela;


    -- USUARIOS QUE ACCEDEN
        CREATE TABLE tbl_user (
            id_user int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_rol int NOT NULL,
            email_cole_user varchar(40) NOT NULL UNIQUE,
            pwd_user char(60) NOT NULL
        );

        CREATE TABLE tbl_roles (
            id_rol int NOT NULL PRIMARY KEY,
            tipo_rol VARCHAR(20) NOT NULL
        );

        ALTER TABLE tbl_user ADD CONSTRAINT fk_rol_user FOREIGN KEY (id_rol) REFERENCES tbl_roles(id_rol);


    -- ALUMNOS

        CREATE TABLE tbl_alumnos (
            matricula_alumno int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre_alumno varchar(25) NOT NULL,
            apellido_alumno varchar(40) NOT NULL,
            dni_alumno char(8) NOT NULL,
            fecha_nac_alumno date NOT NULL,
            direccion_alumno varchar(40),
            telf_alumno char(9) NOT NULL,
            email_cole_alumno varchar(40) NOT NULL,
            email_pri_alumno varchar(40) NOT NULL,
            sexo_user set('H','M')
        );

        CREATE TABLE tbl_asignatura_alumno (
            id_asignatura_alumno int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            matricula_alumno int NOT NULL,
            id_asignatura int NOT NULL,
            nota_asignatura_alumno int NULL
        );

        CREATE TABLE tbl_asignaturas (
            id_asignatura int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre_asignatura varchar(60) NOT NULL
        );

        ALTER TABLE tbl_asignatura_alumno ADD CONSTRAINT fk_alumno_asignatura FOREIGN KEY (matricula_alumno) REFERENCES tbl_alumnos(matricula_alumno);
        ALTER TABLE tbl_asignatura_alumno ADD CONSTRAINT fk_asignatura_alumno FOREIGN KEY (id_asignatura) REFERENCES tbl_asignaturas(id_asignatura);

        CREATE TABLE tbl_cursos_asignaturas (
            id_curso_asignatura int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fecha_asignatura_alumno VARCHAR(10) NOT NULL, -- PONER EN FORMATO 2024-2025
            id_asignatura int NOT NULL,
            id_curso int NOT NULL
        );

        CREATE TABLE tbl_cursos (
            id_curso int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre_curso varchar(60) NOT NULL
        );

        ALTER TABLE tbl_cursos_asignaturas ADD CONSTRAINT fk_asignatura_curso FOREIGN KEY (id_asignatura) REFERENCES tbl_asignaturas(id_asignatura);
        ALTER TABLE tbl_cursos_asignaturas ADD CONSTRAINT fk_curso_asignatura FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id_curso);

-- INSERTS

    INSERT INTO tbl_roles (id_rol, tipo_rol) VALUES
    (1, 'Administrador'),
    (2, 'Secretaria'),
    (3, 'Educador'),
    (4, 'Conserje');

    INSERT INTO tbl_user (id_rol, email_cole_user, pwd_user) VALUES
    (1, 'admin@colegio.com', '$2b$12$N5o77LlTP6gZVv3s0T.R/OcU5ABkjhD9WzRtufto0FZmkDIFDhOm2'), -- Contraseña: Admin123!
    (2, 'secretaria@colegio.com', '$2b$12$G7cTlmbL2ZmVLoVcOI8Y9OcIz9bqRzGZyTW5NB9CBGpIgV5TcoF/.'), -- Contraseña: Secretaria2024
    (3, 'profesor@colegio.com', '$2b$12$yWrOdmycE/.1iHqZMWdCVON1ROgMHN/aAQLnY7AB8rQtOjWQ01hOy'), -- Contraseña: Educador2024
    (4, 'conserje@colegio.com', '$2b$12$3.0W84qPi59KzCAm6JW8ceCpWv.bof20VRsh2MzGHJ43LMuL8iL22'); -- Contraseña: Conserje1234

    INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno, sexo_user) VALUES
    ('Juan', 'Pérez López', '12345678A', '2005-04-15', 'Calle Mayor 123', '612345678', 'juan.perez@colegio.com', 'juan.perez@gmail.com', 'H'),
    ('María', 'García Gómez', '23456789B', '2006-08-23', 'Avenida de la Paz 45', '622345678', 'maria.garcia@colegio.com', 'maria.garcia@yahoo.com', 'M');

    INSERT INTO tbl_asignaturas (nombre_asignatura) VALUES
    ('Matemáticas'),
    ('Lengua y Literatura'),
    ('Inglés'),
    ('Historia'),
    ('Educación Física');

    INSERT INTO tbl_asignatura_alumno (matricula_alumno, id_asignatura, nota_asignatura_alumno) VALUES
    (1, 1, 85), -- Juan Pérez en Matemáticas
    (1, 2, 90), -- Juan Pérez en Lengua y Literatura
    (2, 1, 88), -- María García en Matemáticas
    (2, 3, 92); -- María García en Inglés

    INSERT INTO tbl_cursos (nombre_curso) VALUES
    ('1º ESO'),
    ('2º ESO'),
    ('3º ESO'),
    ('4º ESO'),
    ('Bachillerato');

    INSERT INTO tbl_cursos_asignaturas (fecha_asignatura_alumno, id_asignatura, id_curso) VALUES
    ('2024-2025', 1, 1), -- Matemáticas en 1º ESO
    ('2024-2025', 2, 1), -- Lengua y Literatura en 1º ESO
    ('2024-2025', 3, 2), -- Inglés en 2º ESO
    ('2024-2025', 4, 3); -- Historia en 3º ESO
