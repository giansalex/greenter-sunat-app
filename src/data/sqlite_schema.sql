create table usuario
(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	email TEXT,
	password TEXT
);

create table perfil
(
	user_id INT PRIMARY KEY,
	ruc TEXT,
	razon_social TEXT,
	direccion TEXT
);