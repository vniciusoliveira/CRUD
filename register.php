<?php
include 'includes/db.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);
    $telefone = trim($_POST['telefone']);

    // Validação
    if (empty($nome) || empty($email) || empty($endereco) || empty($telefone)) {
        $message = "<div class='alert error'>Todos os campos são obrigatórios.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='alert error'>Email inválido.</div>";
    } else {
        // Verificar se o email já existe
        $checkEmail = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        if ($checkEmail) {
            $checkEmail->bind_param("s", $email);
            $checkEmail->execute();
            $result = $checkEmail->get_result();

            if ($result->num_rows > 0) {
                $message = "<div class='alert error'>Erro: Este email já está cadastrado.</div>";
            } else {
                // Inserir dados no banco
                $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, endereco, telefone) VALUES (?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("ssss", $nome, $email, $endereco, $telefone);
                    if ($stmt->execute()) {
                        $message = "<div class='alert success'>Novo Registro criado!</div>";
                    } else {
                        $message = "<div class='alert error'>Erro: " . $stmt->error . "</div>";
                    }
                    $stmt->close();
                } else {
                    $message = "<div class='alert error'>Erro ao preparar o insert: " . $conn->error . "</div>";
                }
            }
            $checkEmail->close();
        } else {
            $message = "<div class='alert error'>Erro ao preparar o select: " . $conn->error . "</div>";
        }
    }
}

$conn->close(); // Fecha a conexão após todas as operações
?>

<?php
$title = "Formulário de Cadastro";
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="cadastro.css"> <!-- Incluindo o CSS específico para o cadastro -->
</head>
<body>
    <div class="container"> <!-- Adicionando um container para melhor layout -->
        <h1>Formulário de Cadastro</h1>
        
        <?php if (!empty($message)) echo $message; ?> <!-- Exibindo mensagem de erro ou sucesso -->

        <form action="#" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>

            <div class="btn-container">
                <button type="submit">Enviar</button>
                <a href="users.php" class="btn-voltar">Voltar</a>
            </div>
        </form>

        <a href="users.php" class="btn-voltar">Ver Usuários Cadastrados</a>
    </div>
</body>
</html>
