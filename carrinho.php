<?php
session_start();
include("conexao.php");

if (isset($_COOKIE['carrinho'])) {
    $_SESSION['carrinho'] = unserialize($_COOKIE['carrinho']);
}

if (isset($_GET['adicionar'])) {
    $idProduto = (int)$_GET['adicionar'];
    $quantidade = isset($_GET['quantidade']) ? (int)$_GET['quantidade'] : 1;

    if (isset($_SESSION['carrinho'][$idProduto])) {
        $_SESSION['carrinho'][$idProduto] += $quantidade;
    } else {
        $_SESSION['carrinho'][$idProduto] = $quantidade;
    }

    setcookie('carrinho', serialize($_SESSION['carrinho']), time() + (86400 * 7), "/");
    echo '<script>alert("Item adicionado ao carrinho!"); window.location="carrinho.php";</script>';
}

if (isset($_GET['remover'])) {
    $idProduto = (int)$_GET['remover'];
    if (isset($_SESSION['carrinho'][$idProduto])) {
        unset($_SESSION['carrinho'][$idProduto]);
        setcookie('carrinho', serialize($_SESSION['carrinho']), time() + (86400 * 7), "/");
        echo '<script>alert("Item removido com sucesso!"); window.location="carrinho.php";</script>';
    }
}

if (isset($_GET['limpar'])) {
    $_SESSION['carrinho'] = [];
    setcookie('carrinho', '', time() - 3600, "/");
    echo '<script>alert("Carrinho limpo!"); window.location="carrinho.php";</script>';
}

$produtos = [];
if (!empty($_SESSION['carrinho'])) {
    $idsProdutos = array_keys($_SESSION['carrinho']);
    $placeholders = implode(',', array_fill(0, count($idsProdutos), '?'));
    $sql = "SELECT id, nome, preco FROM produtos WHERE id IN ($placeholders)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($idsProdutos)), ...$idsProdutos);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $idProduto = $row['id'];
        $quantidade = $_SESSION['carrinho'][$idProduto];
        $produtos[] = [
            'id' => $idProduto,
            'nome' => $row['nome'],
            'preco' => $row['preco'],
            'quantidade' => $quantidade,
            'total' => $row['preco'] * $quantidade
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
    <style>
        .botoes { text-align: center; margin-top: 20px; }
        .botoes a { padding: 10px 20px; text-decoration: none; color: white; margin: 0 10px; border-radius: 5px; }
        .continuar { background-color: #5fb382; }
        .finalizar { background-color: #069; }
        h2.title { background-color: #069; width: 100%; padding: 20px; text-align: center; color: white; }
        .carrinho-item { max-width: 1200px; margin: 10px auto; padding-bottom: 10px; border-bottom: 2px dotted #ccc; }
        .carrinho-item p { font-size: 19px; color: #505050; }
    
        .botaofinal .auth-buttons {
            margin-top: 10px;
        }
        .botaofinal button {
            margin: 0 5px;
            text-align: right;
            margin-right: 20px;
            padding: 10px 20px;
            background-color: #e3230d;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            float: right;
        }
        .botaofinal button:hover {
            background-color: #010902;
        }
    </style>
</head>
<body>
    <h2 class="title">Itens no Carrinho</h2>

    <?php if (!empty($produtos)): ?>
        <?php foreach ($produtos as $produto): ?>
            <div class="carrinho-item">
                <p>
                    Nome: <?= htmlspecialchars($produto['nome']) ?> | 
                    Quantidade: <?= $produto['quantidade'] ?> | 
                    Preço unitário: R$ <?= number_format($produto['preco'], 2, ',', '.') ?> | 
                    Total: R$ <?= number_format($produto['total'], 2, ',', '.') ?>
                </p>
                <a href="?remover=<?= $produto['id'] ?>" style="color:red;">Remover</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center;">O carrinho está vazio.</p>
    <?php endif; ?>

    <div class="botoes">
        <a href="homepage.php" class="continuar">Continuar Comprando</a>
        <a href="?limpar=1" class="finalizar">Limpar Carrinho</a>
    </div>
    
    <div class="botaofinal">
    <form method="POST" action="finaliza_compra.php">
        <button type="submit">Finalizar Compra</button>
    </form>
    </div>

</body>
</html>
