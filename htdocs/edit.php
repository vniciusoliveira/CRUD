<?php
include 'includes/db.php';
$user = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        header("Location: users.php");
        exit();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE usuarios SET nome = ?, email = ?, endereco = ?, telefone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $endereco, $telefone, $id);
    
    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        header("Location: edit.php?id=$id&error=1");
        exit();
    }
}

$title = "Editar Usuário"; 
include 'includes/header.php'; // Incluindo o cabeçalho
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="editar.css"> <!-- Incluindo o CSS específico para edição -->
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert error">Erro ao atualizar usuário. Tente novamente.</div>
        <?php endif; ?>

        <?php if ($user): ?>
            <form action="" method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($user['endereco']); ?>" required>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($user['telefone']); ?>" required>

                <button type="submit">Atualizar</button>
            </form>
        <?php else: ?>
            <p>Usuário não encontrado.</p>
        <?php endif; ?>

        <a href="users.php" class="btn-voltar">Voltar</a>
    </div>
</body>
</html>
