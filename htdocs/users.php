<?php
include 'includes/db.php';
$title = "Usuários Cadastrados";
include 'includes/header.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir usuário.');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="usuarios.css"> <!-- Incluindo o CSS específico para a lista de usuários -->
</head>
<body>
    <div class="container"> <!-- Adicionando um container para melhor layout -->
        <h1>Usuários Cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, nome, email, endereco, telefone FROM usuarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nome']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['endereco']}</td>
                                <td>{$row['telefone']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn-editar'>Editar</a>
                                    <a href='users.php?delete={$row['id']}' class='btn-excluir' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="btn-container">
            <a href="register.php" class="btn-voltar">Adicionar Usuário</a>
        </div> <!-- Adicionando a classe do botão -->
    </div>
</body>
</html>
