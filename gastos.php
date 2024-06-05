<?php
include('db.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM transacao WHERE conta_id=(SELECT id FROM conta WHERE id=(SELECT id FROM usuario WHERE email='$email'))";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Gastos</h2>
        <div id="chart"></div>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['descricao']; ?></td>
                    <td><?php echo $row['valor']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                    <td><?php echo $row['categoria_nome']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='add_gasto.php'">Adicionar Novo Gasto</button>
    </div>
    <script src="script.js"></script>
</body>
</html>