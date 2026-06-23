CREATE DATABASE miningdb;
USE miningdb;

CREATE TABLE usuario (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
nickname VARCHAR(50) NOT NULL UNIQUE,
senha VARCHAR(255) NOT NULL
);

CREATE TABLE partida (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario_id INT NOT NULL,
pontos INT NOT NULL,
wpm INT NOT NULL,
precisao INT NOT NULL,
criado_em DATETIME NOT NULL,
FOREIGN KEY (usuario_id) REFERENCES usuario(id));

CREATE TABLE ligas (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
senha VARCHAR(255),
criador_id INT,
criado_em DATETIME NOT NULL,
FOREIGN KEY (criador_id) REFERENCES usuario(id)
);

CREATE TABLE liga_membro (
usuario_id INT NOT NULL,
liga_id INT NOT NULL,
PRIMARY KEY (usuario_id, liga_id),
entrou_em DATETIME,
FOREIGN KEY (usuario_id) REFERENCES usuario(id),
FOREIGN KEY (liga_id) REFERENCES ligas(id));

SELECT * FROM usuario;