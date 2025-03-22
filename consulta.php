<?php
include('conexao.php');

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$sql = "
    SELECT 
        clientes.nome AS cliente_nome,
        clientes.foto AS cliente_foto,
        clientes.comprovante AS cliente_comprovante,
        produtos.nome AS produto_nome,
        produtos.preco AS produto_preco,
        produtos.imagem AS produto_imagem,
        carrinho_compras.quantidade AS quantidade
    FROM 
        clientes
    LEFT JOIN 
        carrinho_compras ON clientes.id = carrinho_compras.cliente_id
    LEFT JOIN 
        produtos ON carrinho_compras.produto_id = produtos.id
    ORDER BY 
        clientes.nome, produtos.nome
";

$result = $mysqli->query($sql);

echo "<table border='1'>
        <tr>
            <th>Cliente</th>
            <th>Foto</th>
            <th>Comprovante</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Imagem</th>
            <th>Quantidade</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . htmlspecialchars($row['cliente_nome']) . "</td>
            <td>";
    if (!empty($row['cliente_foto'])) {
        echo "<img src='" . htmlspecialchars($row['cliente_foto']) . "' width='50' height='50'>";
    } else {
        echo "Sem foto";
    }
    echo "</td>
            <td>";
    if (!empty($row['cliente_comprovante'])) {
        echo "<a href='" . htmlspecialchars($row['cliente_comprovante']) . "'>Baixar PDF</a>";
    } else {
        echo "Sem comprovante";
    }
    echo "</td>
            <td>" . (!empty($row['produto_nome']) ? htmlspecialchars($row['produto_nome']) : "Nenhum produto") . "</td>
            <td>" . (!empty($row['produto_preco']) ? "R$ " . number_format($row['produto_preco'], 2, ',', '.') : "-") . "</td>
            <td>";
    if (!empty($row['produto_imagem'])) {
        echo "<img src='" . htmlspecialchars($row['produto_imagem']) . "' width='50' height='50'>";
    } else {
        echo "Sem imagem";
    }
    echo "</td>
            <td>" . (!empty($row['quantidade']) ? $row['quantidade'] : "-") . "</td>
          </tr>";
}

echo "</table>";

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta Cadastro</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: gainsboro;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #e3230d;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 15px;
        text-align: center;
    }

    table th {
        background-color: #e3230d;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
    }

    table td {
        font-size: 14px;
        color: #555;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    img {
        border-radius: 5px;
    }

    a {
        text-decoration: none;
        color: #e3230d;
    }

    a:hover {
        text-decoration: underline;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 0;
        background-color: #007BFF;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    footer {
        margin-top: 20px;
        text-align: center;
        color: #888;
        font-size: 12px;
    }
</style>
</head>
</body>
</html>