DROP DATABASE IF EXISTS bd_escuela;

-- CREACION BBDD

    CREATE DATABASE bd_escuela;

    Use bd_escuela;


    -- USUARIOS QUE ACCEDEN
        CREATE TABLE tbl_user (
            id_user int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_rol int NOT NULL,
            nombre_user varchar(30) NOT NULL,
            apellidos_user varchar(40) NOT NULL,
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
            dni_alumno char(9) NOT NULL,
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

    INSERT INTO tbl_user (id_rol, nombre_user, apellidos_user, email_cole_user, pwd_user) VALUES
    (1, 'Sandra', 'Hernandez', 'admin@colegio.com', '$2y$10$ghDs4NA9mdKu7Sw3DPLQ9uDB5tnMrqBbEClRefXZ4jHSH9.R6OCFK'), -- Contraseña: Barcelona1234!
    (2, 'Jaime', 'Gutierrez', 'secretaria@colegio.com', '$2y$10$ghDs4NA9mdKu7Sw3DPLQ9uDB5tnMrqBbEClRefXZ4jHSH9.R6OCFK'), -- Contraseña: Barcelona1234!
    (3, 'Pablo', 'Casanovas', 'profesor@colegio.com', '$2y$10$ghDs4NA9mdKu7Sw3DPLQ9uDB5tnMrqBbEClRefXZ4jHSH9.R6OCFK'), -- Contraseña: Barcelona1234!
    (4, 'Maria', 'Perez', 'conserje@colegio.com', '$2y$10$ghDs4NA9mdKu7Sw3DPLQ9uDB5tnMrqBbEClRefXZ4jHSH9.R6OCFK'); -- Contraseña: Barcelona1234!

    INSERT INTO tbl_alumnos (nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno, sexo_user) VALUES
    ('Juan', 'Pérez López', '23456788A', '2005-04-15', 'Calle Mayor 123', '612345678', 'juan.perez@colegio.com', 'juan.perez@gmail.com', 'H'),
    ('María', 'García Gómez', '72456789B', '2006-08-23', 'Avenida de la Paz 45', '622345678', 'maria.garcia@colegio.com', 'maria.garcia@yahoo.com', 'M'),
    ('Carlos', 'Sánchez Ruiz', '83654781C', '2004-11-12', 'Calle del Sol 78', '633456789', 'carlos.sanchez@colegio.com', 'carlos.sanchez@hotmail.com', 'H'),
    ('Lucía', 'Martínez Díaz', '93765842D', '2005-07-20', 'Calle Libertad 98', '644567890', 'lucia.martinez@colegio.com', 'lucia.martinez@gmail.com', 'M'),
    ('Pedro', 'Rodríguez Pérez', '12345678E', '2005-02-05', 'Calle del Mar 45', '655678901', 'pedro.rodriguez@colegio.com', 'pedro.rodriguez@yahoo.com', 'H'),
    ('Ana', 'López Fernández', '23456789F', '2006-01-18', 'Avenida Andalucía 65', '666789012', 'ana.lopez@colegio.com', 'ana.lopez@gmail.com', 'M'),
    ('Javier', 'González López', '34567890G', '2004-06-25', 'Calle del Río 34', '677890123', 'javier.gonzalez@colegio.com', 'javier.gonzalez@aol.com', 'H'),
    ('Raquel', 'Hernández García', '45678901H', '2005-09-11', 'Calle del Sol 23', '688901234', 'raquel.hernandez@colegio.com', 'raquel.hernandez@outlook.com', 'M'),
    ('David', 'Jiménez Martínez', '56789012I', '2006-03-02', 'Calle de la Paz 56', '699012345', 'david.jimenez@colegio.com', 'david.jimenez@yahoo.com', 'H'),
    ('Sofía', 'Ramírez Sánchez', '67890123J', '2005-12-30', 'Avenida Madrid 12', '610123456', 'sofia.ramirez@colegio.com', 'sofia.ramirez@hotmail.com', 'M'),
    ('Alberto', 'Fernández Gómez', '78901234K', '2004-10-01', 'Calle Los Pinos 67', '611234567', 'alberto.fernandez@colegio.com', 'alberto.fernandez@gmail.com', 'H'),
    ('Beatriz', 'Díaz Jiménez', '89012345L', '2006-04-22', 'Calle Granada 89', '622345678', 'beatriz.diaz@colegio.com', 'beatriz.diaz@live.com', 'M'),
    ('Ricardo', 'Muñoz Torres', '90123456M', '2005-06-09', 'Calle Roma 45', '633456789', 'ricardo.munoz@colegio.com', 'ricardo.munoz@outlook.com', 'H'),
    ('Marina', 'Moreno Ruiz', '01234567N', '2004-05-15', 'Avenida Sevilla 23', '644567890', 'marina.moreno@colegio.com', 'marina.moreno@yahoo.com', 'M'),
    ('Antonio', 'Álvarez Castro', '12345678O', '2005-01-30', 'Calle Zaragoza 34', '655678901', 'antonio.alvarez@colegio.com', 'antonio.alvarez@gmail.com', 'H'),
    ('Pilar', 'Serrano Ruiz', '23456789P', '2006-02-19', 'Calle Ronda 90', '666789012', 'pilar.serrano@colegio.com', 'pilar.serrano@hotmail.com', 'M'),
    ('Fernando', 'García Ruiz', '34567890Q', '2004-07-10', 'Avenida Cataluña 12', '677890123', 'fernando.garcia@colegio.com', 'fernando.garcia@live.com', 'H'),
    ('Marta', 'Torres Sánchez', '45678901R', '2005-10-05', 'Calle San José 56', '688901234', 'marta.torres@colegio.com', 'marta.torres@gmail.com', 'M'),
    ('Andrés', 'Lozano Pérez', '56789012S', '2006-12-02', 'Calle del Campo 34', '699012345', 'andres.lozano@colegio.com', 'andres.lozano@outlook.com', 'H'),
    ('Isabel', 'Cruz Sánchez', '67890123T', '2005-04-13', 'Calle Tetuán 23', '610123456', 'isabel.cruz@colegio.com', 'isabel.cruz@hotmail.com', 'M'),
    ('Luis', 'Vázquez García', '78901234U', '2004-02-28', 'Calle Fuerteventura 67', '611234567', 'luis.vazquez@colegio.com', 'luis.vazquez@gmail.com', 'H'),
    ('Esther', 'Álvarez Pérez', '89012345V', '2006-05-22', 'Avenida León 45', '622345678', 'esther.alvarez@colegio.com', 'esther.alvarez@aol.com', 'M'),
    ('Victor', 'Navarro López', '01234567W', '2005-11-12', 'Calle Toledo 67', '633456789', 'victor.navarro@colegio.com', 'victor.navarro@yahoo.com', 'H'),
    ('Carmen', 'Silva Fernández', '12345678X', '2004-03-16', 'Calle Valencia 34', '644567890', 'carmen.silva@colegio.com', 'carmen.silva@aol.com', 'M'),
    ('Santiago', 'Méndez Pérez', '23456789Y', '2006-09-25', 'Avenida Almería 12', '655678901', 'santiago.mendez@colegio.com', 'santiago.mendez@gmail.com', 'H'),
    ('Eva', 'Gutiérrez Martínez', '34567890Z', '2005-12-10', 'Calle Badajoz 23', '666789012', 'eva.gutierrez@colegio.com', 'eva.gutierrez@live.com', 'M'),
    ('Óscar', 'Moreno Sánchez', '45678901A', '2004-11-20', 'Calle Málaga 45', '677890123', 'oscar.moreno@colegio.com', 'oscar.moreno@outlook.com', 'H'),
    ('Paula', 'Jiménez García', '56789012B', '2005-03-12', 'Calle Canarias 67', '688901234', 'paula.jimenez@colegio.com', 'paula.jimenez@gmail.com', 'M'),
    ('Ramón', 'Sánchez Hernández', '67890123C', '2006-07-03', 'Calle Cuenca 56', '699012345', 'ramon.sanchez@colegio.com', 'ramon.sanchez@yahoo.com', 'H');


   INSERT INTO tbl_asignaturas (nombre_asignatura) VALUES
    ('Matemáticas'),
    ('Lengua y Literatura'),
    ('Inglés'),
    ('Historia'),
    ('Educación Física'),
    ('Ciencias Sociales'),
    ('Ciencias Naturales'),
    ('Geografía'),
    ('Filosofía'),
    ('Tecnología');

    INSERT INTO tbl_asignatura_alumno (matricula_alumno, id_asignatura, nota_asignatura_alumno) VALUES
    (1, 1, 85),
    (1, 2, 88),
    (1, 3, 75),
    (1, 4, 79),
    (1, 5, 92),
    (1, 6, 87),
    (1, 7, 79),
    (1, 8, 92),
    (1, 9, 87),
    (1, 10, 87);

    INSERT INTO tbl_cursos (nombre_curso) VALUES
    ('1º ESO'), ('2º ESO'), ('3º ESO'), ('4º ESO'), ('Bachillerato');

    INSERT INTO tbl_cursos_asignaturas (fecha_asignatura_alumno, id_asignatura, id_curso) VALUES
    ('2024-2025', 1, 1), ('2024-2025', 2, 1), ('2024-2025', 3, 1), 
    ('2024-2025', 4, 1), ('2024-2025', 5, 1), ('2024-2025', 6, 1),
    ('2024-2025', 7, 1), ('2024-2025', 8, 1), ('2024-2025', 9, 1),
    ('2024-2025', 10, 1);

    INSERT INTO tbl_cursos_asignaturas (fecha_asignatura_alumno, id_asignatura, id_curso) VALUES
    ('2023-2024', 1, 2), ('2023-2024', 2, 2), ('2023-2024', 3, 2), 
    ('2023-2024', 4, 2), ('2023-2024', 5, 2), ('2023-2024', 6, 2),
    ('2023-2024', 7, 2), ('2023-2024', 8, 2), ('2023-2024', 9, 2),
    ('2023-2024', 10, 2);