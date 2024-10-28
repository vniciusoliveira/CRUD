<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "formulario";

// Criar conexão
$conn = new mysqli($servername, $username, $password);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o banco de dados existe
$db_check = $conn->select_db($dbname);
if (!$db_check) {
    // Se o banco não existir, cria o banco de dados
    $sql = "CREATE DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Banco de dados '$dbname' criado com sucesso.";
    } else {
        die("Erro ao criar o banco de dados: " . $conn->error);
    }

    // Selecionar o banco de dados recém-criado
    $conn->select_db($dbname);

    // Criar uma tabela (se necessário) no banco de dados criado
    $sql_table = "CREATE TABLE usuarios (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        endereco VARCHAR(150),
        telefone VARCHAR(15)
    )";
    

    if ($conn->query($sql_table) === TRUE) {
        echo "Tabela 'exemplo' criada com sucesso.";
    } else {
        die("Erro ao criar a tabela: " . $conn->error);
    }
}


?>
