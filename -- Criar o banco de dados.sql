-- Criar o banco de dados
CREATE DATABASE app;

-- Usar o banco de dados recém-criado
USE app;

-- Criar a tabela plano_contas
CREATE TABLE plano_contas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL
);

-- Inserir dados na tabela plano_contas
INSERT INTO plano_contas (codigo, descricao) VALUES 
('1001', 'Caixa'),
('1002', 'Banco Conta Movimento'),
('2001', 'Clientes'),
('2002', 'Fornecedores'),
('3001', 'Imobilizado'),
('3002', 'Depreciação Acumulada');
