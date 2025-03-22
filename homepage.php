<?php
session_start();
include('conexao.php');

$usuarioLogado = isset($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodrigueira Guitarras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #282c34;
            text-align: center;
        }
        header {
            background-color: #f5f6f7;
            background-image: url("rodriguerafundo.png");
            color: #fbfbfc;
            padding: 50px 0;
            margin-bottom: 20px;
        }
        header h1 {
            margin: 0;
        }
        header .auth-buttons {
            margin-top: 10px;
        }
        header button {
            margin: 0 5px;
            padding: 10px 20px;
            background-color: #e3230d;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        header button:hover {
            background-color: #010902;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 80px;
            padding: 20px;
        }
        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(211, 153, 153, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
        .card .info {
            padding: 20px;
        }
        .card .info h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }
        .card .info p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
        .card button {
            padding: 10px 20px;
            background-color: #e3230d;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .card button:hover {
            background-color: #010902;
        }
        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f5f6f9;
            color: rgb(4, 7, 39);
        }
    </style>
</head>
<body>

<header>
    <h1>Rodrigueira Guitarras</h1>

    <?php if ($usuarioLogado): ?>
        <div style="text-align: right; margin-right: 20px;">
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
            <button onclick="location.href='logout.php'">Sair</button>
            <button onclick="location.href='pagina_usuario.php'">Acesse seus dados</button>
        </div>
    <?php else: ?>
        <div class="auth-buttons">
            <button onclick="location.href='cadastro.php'">Cadastre-se</button>
            <button onclick="location.href='login.php'">Login</button>
        </div>
    <?php endif; ?>
</header>

<main>
    <div class="container">
        <?php
        $sql = "SELECT id, nome, preco, imagem FROM produtos";
        $result = $mysqli->query($sql);

        while ($produto = $result->fetch_assoc()) {
            echo '<div class="card">
                    <img src="' . htmlspecialchars($produto['imagem']) . '" alt="' . htmlspecialchars($produto['nome']) . '" onclick="ampliarImagem(this)">
                    <div class="info">
                        <h3>' . htmlspecialchars($produto['nome']) . '</h3>
                        <p>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</p>';
                        
            
            if ($usuarioLogado) {
                echo '<form action="adicionar_ao_carrinho.php" method="POST">
                        <input type="hidden" name="id" value="' . $produto['id'] . '">
                        <button type="submit">Adicionar ao Carrinho</button>
                      </form>';
            } else {
                echo '<button onclick="location.href=\'login.php\'">Login para Comprar</button>';
            }

            echo '  </div>
                  </div>';
        }
        ?>
    </div>
</main>

<footer>
    <p>&copy; 2024 Rodriguera Guitarras. Todos os direitos reservados.</p>
</footer>

<script>
    function ampliarImagem(img) {
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        overlay.style.display = 'flex';
        overlay.style.alignItems = 'center';
        overlay.style.justifyContent = 'center';
        overlay.style.zIndex = '1000';

        const enlargedImg = document.createElement('img');
        enlargedImg.src = img.src;
        enlargedImg.style.width = '60%';
        enlargedImg.style.borderRadius = '10px';

        overlay.appendChild(enlargedImg);

        overlay.onclick = function () {
            document.body.removeChild(overlay);
        };

        document.body.appendChild(overlay);
    }
</script>

</body>
</html>
