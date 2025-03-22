<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

    
        $sql_code = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: homepage.php");

        } else {
            echo "
            <script>
                alert('Falha no login. Tente novamente');
                window.location.href = 'login.php';
            </script>
        ";
        }

    }

}
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
            margin-top: 280px;
            width: 100%;
            padding: 20px;
            background-color: gainsboro;
            text-align: center; 
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

<header>
    <h1></h1>
</header>

    <div class="container">
        <h1>Acesse sua conta</h1>
        <form action="" method="POST">
            <p>
                <label>E-mail</label>
                <input type="text" name="email">
            </p>
            
            <p>
                <label>Senha</label>
                <input type="password" name="senha">
            </p>
        
            <p>
                <button type="submit">Entrar</button>
            </p>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Rodriguera Guitarras. Todos os direitos reservados.</p>
    </footer>

</body>
</html>