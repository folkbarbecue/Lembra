<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PI/connect/conexao.php';

// Buscando dados da tabela cadastro
$query = $conexao->query("SELECT * FROM cadastro");
$cadastros = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Cadastros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard de Cadastros</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Tipo</th>
                    <th>Médico</th>
                    <th>Restrições</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cadastros as $cadastro): ?>
                    <tr>
                        <td><?= $cadastro['id_pac'] ?></td>
                        <td><?= htmlspecialchars($cadastro['nome']) ?></td>
                        <td><?= htmlspecialchars($cadastro['cpf']) ?></td>
                        <td><?= htmlspecialchars($cadastro['telefone']) ?></td>
                        <td><?= htmlspecialchars($cadastro['tipo']) ?></td>
                        <td><?= htmlspecialchars($cadastro['medico']) ?></td>
                        <td><?= htmlspecialchars($cadastro['restricao']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $cadastro['id_pac'] ?>">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
