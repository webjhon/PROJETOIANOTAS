-- Cria o banco de dados e as tabelas utilizadas pela aplicação
CREATE DATABASE IF NOT EXISTS alimentaia DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE alimentaia;

-- Tabela utilizada para armazenar as informações enviadas pelo formulário
CREATE TABLE IF NOT EXISTS dados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Disciplina VARCHAR(100) NOT NULL,
    Nota DECIMAL(5,2),
    Hora TIME,
    nome VARCHAR(100) NOT NULL
);

-- Tabela opcional para registrar o planejamento das aulas
CREATE TABLE IF NOT EXISTS planejamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    disciplina VARCHAR(100) NOT NULL,
    data DATE NOT NULL,
    conteudo TEXT NOT NULL
);
