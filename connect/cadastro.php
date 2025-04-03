<?php
// Conexão com o banco de dados
include('conexao.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo'];
    $doenca_cognitiva = $_POST['medico']; // Alterado para 'doença cognitiva'
    $restricao = $_POST['restricao'];

    // Verifica se o CPF já existe
    $sql_check = "SELECT * FROM cadastro WHERE cpf = '$cpf'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Erro: CPF já cadastrado. Tente outro.";
    } else {
        // Insere os dados no banco de dados
        $sql = "INSERT INTO cadastro (nome, cpf, telefone, tipo, medico, restricao) VALUES ('$nome', '$cpf', '$telefone', '$tipo', '$doenca_cognitiva', '$restricao')";

        if (mysqli_query($conn, $sql)) {
            // Salva os dados no Local Storage para usar na p3.html
            echo "<script>
                localStorage.setItem('dados', JSON.stringify({ nome: '$nome', doenca: '$doenca_cognitiva' }));
                window.location.href = '../p3.html'; // Redireciona para p3.html
            </script>";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Fecha a conexão
mysqli_close($conn);
?>
