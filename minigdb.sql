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

/*rank Global Desde a Criação*/
SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
GROUP BY u.id
ORDER BY total_pontos DESC;

/*Rank Global semanal*/
SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
WHERE YEARWEEK(p.criado_em, 1) = YEARWEEK(NOW(), 1)
GROUP BY u.id
ORDER BY total_pontos DESC;

/*Lista de Ligas*/
SELECT l.id, l.nome, l.criado_em, u.nickname AS criador
FROM ligas l
JOIN usuario u ON u.id = l.criador_id
ORDER BY l.criado_em DESC;

/*Verificação se o usuário já está em outra liga*/
SELECT liga_id FROM liga_membro WHERE usuario_id = ?;

SELECT * FROM usuario;
SELECT * FROM partida;
SELECT * FROM ligas;