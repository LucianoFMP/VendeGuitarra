<?php
session_start();

include("conexao.php");

$id = $_SESSION['id'] ?? null;

if ($id) {
    $stmt = $mysqli->prepare("SELECT * FROM clientes WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    $user = null;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Usuário</title>
    <style>
        body {
            background-image: url('rodriguerafundo.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        .container h1 {
            color: #e3230d;
            font-size: 24px;
        }

        .container p {
            font-size: 18px;
            margin: 10px 0;
        }

        .container img {
            border-radius: 8px;
            margin: 20px 0;
        }

        .container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e3230d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }

        .container a:hover {
            background-color: #010902;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($user): ?>
            <h1>Bem-vindo, <?php echo htmlspecialchars($user['nome'] ?? 'Usuário'); ?></h1>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($user['email'] ?? 'Não informado'); ?></p>
            
            <?php if (!empty($user['foto'])): ?>
                <img src="<?php echo htmlspecialchars($user['foto']); ?>" alt="Foto de Perfil" width="200">
            <?php else: ?>
                <p>Foto não disponível.</p>
            <?php endif; ?>
            
            <p><strong>Ver comprovante</strong></p>
            
            <?php if (!empty($user['comprovante'])): ?>
                <a href="<?php echo htmlspecialchars($user['comprovante']); ?>" target="_blank">Visualizar Comprovante</a>
            <?php else: ?>
                <p>Comprovante não disponível.</p>
            <?php endif; ?>


            <p><strong>Carrinho:</strong></p>
            <a href="carrinho.php">Ver Carrinho</a>
            <a href="homepage.php">Escolher guitarra</a>
        <?php else: ?>
            <h1>Erro</h1>
            <p>Usuário não encontrado ou sessão inválida.</p>
            <a href="homepage.php">Voltar à Página Inicial</a>
        <?php endif; ?>
    </div>
</body>
</html>