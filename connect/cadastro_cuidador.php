<?php
include 'conexao.php';

// Obtendo os dados do formulário de cadastro do cuidador
$nomeCuidador = $_POST['nome_cuidador'];
$emailCuidador = $_POST['email_cuidador'];
$senhaCuidador = $_POST['senha_cuidador'];
$cpfPaciente = $_POST['cpf_paciente'];

// Verificando se o CPF do paciente existe no sistema
$sql = "SELECT nome FROM pacientes WHERE cpf = :cpf";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cpf', $cpfPaciente);
$stmt->execute();
$paciente = $stmt->fetch();

if ($paciente) {
    $sqlInsert = "INSERT INTO cuidadores (nome, email, senha, cpf_paciente) VALUES (:nome, :email, :senha, :cpf_paciente)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->bindParam(':nome', $nomeCuidador);
    $stmtInsert->bindParam(':email', $emailCuidador);
    $stmtInsert->bindParam(':cpf_paciente', $cpfPaciente);

    if ($stmtInsert->execute()) {
        // Redireciona para p10.html com o nome do cuidador e do paciente
        session_start();
        $_SESSION['nome_cuidador'] = $nomeCuidador;
        $_SESSION['nome_paciente'] = $paciente['nome'];
        header("Location: p10.html");
        exit;
    } else {
        echo "Erro ao cadastrar o cuidador. Tente novamente.";
    }
} else {
    echo "O CPF do paciente não está registrado no sistema.";
}
?>
