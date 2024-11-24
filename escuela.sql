
-- CREACION BBDD

    CREATE DATABASE bd_escuela;

    Use bd_escuela;


    -- USUARIOS QUE ACCEDEN
        CREATE TABLE tbl_user (
            id_user int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_rol int NOT NULL,
            email_user varchar(40) NOT NULL UNIQUE,
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

    INSERT INTO tbl_user (id_rol, email_user, pwd_user) VALUES
    (1, 'admin@fje.edu', '$2b$12$54LVI/19/ivDzYdrR8RBk./gX7DkAeUafNYep5WaSbxF0l2ehnnWC'); -- PWD (BYCRYPT) --> qweQWE123

    INSERT INTO tbl_alumnos (matricula_alumno, nombre_alumno, apellido_alumno, dni_alumno, fecha_nac_alumno, direccion_alumno, telf_alumno, email_cole_alumno, email_pri_alumno, sexo_user) VALUES
    (2425000001, 'Juan', 'Pérez', '12115682', '2010-05-15', 1, 'Av. Avemaria 123', '673347671', 'juanPj23@fje.edu', 'juan.perez@gmail.com', 'H'),
    (2425000002, 'María', 'Gómez', '24833783', '2008-06-20', 2, 'Calle Falsa 45', '623857785', 'mariaGj23@fje.edu', 'marigomez@gmail.com', 'M'),
    (2425000003, 'Carlos', 'López', '56577126', '2008-07-25', 3, 'Calle Real 789', '666567892', 'carlosLj23@fje.edu', 'carloopez@gmail.com', 'H'),
    (2425000004, 'Ana', 'Martínez', '43661191', '2009-08-30', 4, 'Av. Cristóbal Colón 23', '645574900', 'anaMj23@fje.edu', 'ana.martinez@gmail.com', 'M'),
    (2425000005, 'Luis', 'Fernández', '46623090', '2008-09-10', 5, 'Av. América 14', '65699444', 'luisFj23@fje.edu', 'luisfer@gmail.com', 'H');

-- CONSULTAS

    select * from tbl_user inner join tbl_roles
        on tbl_user.id_rol=tbl_roles.id_rol
        where tipo_rol='Administrador';