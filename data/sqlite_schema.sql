CREATE TABLE usuario
(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	email TEXT,
	password TEXT
);

CREATE TABLE perfil
(
	user_id INT PRIMARY KEY,
	ruc TEXT,
	razon_social TEXT,
	direccion TEXT,
	user_sol TEXT,
	clave_sol TEXT,
	FOREIGN KEY (user_id) REFERENCES usuario(id)
);

CREATE TABLE product_category
(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	code TEXT,
	description TEXT,
	user_Id INT,
	FOREIGN KEY(user_Id) REFERENCES usuario(id)
);