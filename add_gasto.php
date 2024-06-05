<?php
include('db.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $email = $_SESSION['email'];
    
    $sql = "INSERT INTO transacao (descricao, valor, data, categoria_nome, conta_id) VALUES ('$descricao', '$valor', '$data', '$categoria', (SELECT id FROM conta WHERE id=(SELECT id FROM usuario WHERE email='$email')))";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: gastos.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Gasto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Adicionar Gasto</h2>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <input type="text" name="categoria" placeholder="Categoria" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>