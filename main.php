<?php
include('db.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT nomeCompleto FROM usuario WHERE email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo $user['nomeCompleto']; ?></h2>
        <input type="text" placeholder="Pesquisar...">
        <div class="grid">
            <a href="gastos.php">Gastos</a>
            <a href="economias.php">Economias</a>
            <a href="investimentos.php">Investimentos</a>
        </div>
        <button onclick="window.location.href='gastos.php'">Adicionar Novo Gasto</button>
    </div>
</body>
</html>