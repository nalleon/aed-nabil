
SET MODE MYSQL;

DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  id int AUTO_INCREMENT,
  nombre varchar(45) NOT NULL,
  password varchar(200) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  rol varchar(45) NOT NULL,
  verificado int DEFAULT 0,
  token_verificacion VARCHAR(255), 
  fecha_creacion BIGINT,
  CONSTRAINT pk_usuarios PRIMARY KEY(id),
  CONSTRAINT uq_correo UNIQUE KEY(correo)
);



INSERT INTO usuarios (id, nombre, password, correo, verificado, rol) VALUES
(1, 'root', '$2a$10$WvhH/Cgd2cVElEEQfeF.8uOQci5KDn9bXP1vlxQBmI5pOmpkcOJ9i','root@root.es', 1, 'ROLE_ADMIN'),
(2, 'lui', '$2a$10$0xezsvQnVm/I.DOTqprt9esmD4wava7gVY/oZB2HlaUz.ZaJP7sa2','lui@lui.es', 1, 'ROLE_USER'),
(3, 'anitita', '$2a$10$zvuDxpKR.9xerEth4PzoDOySS8h2La5euRlVKEPabr9CkBqISnYGa','anitita@anitita.es',0, 'ROLE_USER');


