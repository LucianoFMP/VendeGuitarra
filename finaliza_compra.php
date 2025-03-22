<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION['carrinho'])) {
        $carrinho = $_SESSION['carrinho'];
        $cliente_id = $_SESSION['id'];

        
        $produtos_comprados = [];

        $sql_insert = "INSERT INTO carrinho_compras (cliente_id, produto_id, quantidade) VALUES (?, ?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);

        foreach ($carrinho as $produto_id => $quantidade) {
            $stmt_insert->bind_param("iii", $cliente_id, $produto_id, $quantidade);
            $stmt_insert->execute();

            
            $sql_produto = "SELECT nome FROM produtos WHERE id = ?";
            $stmt_produto = $mysqli->prepare($sql_produto);
            $stmt_produto->bind_param("i", $produto_id);
            $stmt_produto->execute();
            $result_produto = $stmt_produto->get_result();
            $produto = $result_produto->fetch_assoc();

            
            $produtos_comprados[] = $produto['nome'] . " (Quantidade: $quantidade)";
        }

        
        unset($_SESSION['carrinho']);
        setcookie('carrinho', '', time() - 3600, "/");

        
        $mensagem_sucesso = "Parabéns, você adquiriu: " . implode(", ", $produtos_comprados);

        
        echo "
            <script>
                alert('$mensagem_sucesso');
                window.location.href = 'detalhe_pedidos.php';
            </script>
        ";
        exit();
    } else {
        echo "
            <script>
                alert('Erro: Nenhum item no carrinho para finalizar.');
                window.location.href = 'carrinho.php';
            </script>
        ";
        exit();
    }
} else {
    echo "
        <script>
            alert('Ação inválida.');
            window.location.href = 'carrinho.php';
        </script>
    ";
    exit();
}
