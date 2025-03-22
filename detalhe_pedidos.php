<?php
session_start();
include("conexao.php");


if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$cliente_id = $_SESSION['id'];

$sql = "SELECT p.nome, p.preco, c.quantidade
        FROM carrinho_compras c
        JOIN produtos p ON c.produto_id = p.id
        WHERE c.cliente_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-image: url("rodriguerafundo.png");
            background-repeat: no-repeat;
            background-color: gainsboro;
        }
        
        header {
            color: white;
            padding: 30px 0;
            margin-bottom: 20px;
        }
        header h1 {
            margin: 0;
        }
        
        .container {
            margin-top: 350px;
            width: 100%;
            padding: 20px;
            background-color: gainsboro;
            text-align: left; 
        }
      
        footer {
            margin-top: 50px;
            padding: 10px;
            background-color: #f5f6f9;
            color: rgb(4, 7, 39);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalhes do seu Pedido</h1>
        <ul>
            <?php while ($produto = $result->fetch_assoc()): ?>
                <?php 
                
                $subtotal = $produto['preco'] * $produto['quantidade'];
                $total += $subtotal;
                ?>
                <li>
                    <?php echo htmlspecialchars($produto['nome']); ?> - 
                    Quantidade: <?php echo $produto['quantidade']; ?> - 
                    Preço unitário: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?> - 
                    Subtotal: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <h2>Total da Compra: R$ <?php echo number_format($total, 2, ',', '.'); ?></h2>
        <a href="homepage.php">Voltar à página inicial</a>
    </div>

    <footer>
        <p>&copy; 2024 Rodriguera Guitarras. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
