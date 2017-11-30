CREATE TABLE usuario
(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(100),
	`password` VARCHAR(120)
) ENGINE=InnoDB;


CREATE TABLE `perfil` (
  `user_id` int(11) NOT NULL,
  `ruc` char(11) DEFAULT NULL,
  `razon_social` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `user_sol` varchar(20) DEFAULT NULL,
  `clave_sol` varchar(30) DEFAULT NULL
) ENGINE=InnoDB ;

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `user_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB ;

