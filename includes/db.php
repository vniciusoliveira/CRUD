<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "formulario";

// Criar conexão com o servidor
$conn = new mysqli($servername, $username, $password);

// Verificar conexão com o servidor
if ($conn->connect_error) {
    die("Conexão com o servidor falhou: " . $conn->connect_error);
}

// Tentar criar o banco de dados se ele não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Erro ao verificar/criar o banco de dados: " . $conn->error);
}

// Selecionar o banco de dados
$conn->select_db($dbname);

// Tentar criar a tabela 'usuarios' se ela ainda não existir
$sql_table = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    endereco VARCHAR(150),
    telefone VARCHAR(15)
)";
if ($conn->query($sql_table) !== TRUE) {
    die("Erro ao verificar/criar a tabela: " . $conn->error);
}

?>
