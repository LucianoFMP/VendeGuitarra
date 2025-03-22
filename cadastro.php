<?php

session_start ();

include ("conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('rodriguerafundo.png');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input {
            width: 98%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #e3230d;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #010902;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Cadastro</h1>
        <form action="cadastro_finalizar.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Digite um e-mail válido" required>

            <label for="senha">Senha:</label>
            <input type=password id="senha" name="senha" placeholder="Crie uma senha" required>

            <label for="foto">Foto de Perfil (.jpg):</label>
            <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png, .gif" required>
            <small>Formatos permitidos: .jpg, .jpeg, .png, .gif. Tamanho máximo: 2MB.</small>
            <br></br>
            <br></br>

            <label for="comprovante">Comprovante de Inscrição na Ordem dos Músicos:</label>
            <input type="file" id="comprovante" name="comprovante" accept=".pdf" required>
            <small>Formato permitido: .pdf. Tamanho máximo: 2MB.</small>
            <br></br>
            <br></br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>

