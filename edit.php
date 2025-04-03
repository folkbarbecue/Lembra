<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PI/connect/conexao.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conexao->prepare("SELECT * FROM cadastro WHERE id_pac = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cadastro = $result->fetch_assoc();

    if (!$cadastro) {
        die("Cadastro não encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
    $medico = mysqli_real_escape_string($conexao, $_POST['medico']);
    $restricao = mysqli_real_escape_string($conexao, $_POST['restricao']);

    $sql = "UPDATE cadastro SET nome = ?, cpf = ?, telefone = ?, tipo = ?, medico = ?, restricao = ? WHERE id_pac = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $cpf, $telefone, $tipo, $medico, $restricao, $id);
    $stmt->execute();

    header("Location: dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Cadastro</h1>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cadastro['nome']) ?>" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cadastro['cpf']) ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cadastro['telefone']) ?>" required>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($cadastro['tipo']) ?>" required>

            <label for="medico">Médico:</label>
            <input type="text" id="medico" name="medico" value="<?= htmlspecialchars($cadastro['medico']) ?>" required>

            <label for="restricao">Restrições:</label>
            <textarea id="restricao" name="restricao" required><?= htmlspecialchars($cadastro['restricao']) ?></textarea>

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
