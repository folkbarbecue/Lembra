<?php
$servername = "sql301.infinityfree.com";
$username = "if0_37524636";
$password = "yN21AY2kQT2"; // Atualize conforme necessário
$dbname = "if0_37524636_lucas"; // Nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
