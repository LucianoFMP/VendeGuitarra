<?php

session_start ();

include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$foto = $_FILES['foto'];
$comprovante = $_FILES['comprovante'];
$allowedTypesFoto = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
$allowedTypesComprovante = ['application/pdf'];
$fotoPath = "";
$comprovantePath = "";
$maxSize = 2 * 1024 * 1024;

if ($foto['error'] === 0) {
    if ($foto['size'] <= $maxSize && in_array($foto['type'], $allowedTypesFoto)) {
        $dimensions = getimagesize($foto['tmp_name']);
        if ($dimensions[0] <= 1024 && $dimensions[1] <= 1024) {
            $fotoPath = "uploads/" . uniqid() . "_" . basename($foto['name']);
            move_uploaded_file($foto['tmp_name'], $fotoPath);
        } else {
            die("Erro: As dimensões da foto devem ser no máximo 1024x1024 pixels.");
        }
    } else {
        die("Erro: A foto deve ser um arquivo JPEG com tamanho máximo de 2MB.");
    }
} else {
    die("Erro no upload da foto.");
}

if ($comprovante['error'] === 0) {
    if ($comprovante['size'] <= $maxSize && in_array($comprovante['type'], $allowedTypesComprovante)) {
        $comprovantePath = "uploads/" . uniqid() . "_" . basename($comprovante['name']);
        move_uploaded_file($comprovante['tmp_name'], $comprovantePath);
    } else {
        die("Erro: O comprovante deve ser um arquivo PDF com tamanho máximo de 2MB.");
    }
} else {
    die("Erro no upload do comprovante.");
}

$stmt = $mysqli->prepare("INSERT INTO clientes (nome, email, senha, foto, comprovante) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $email, $senha, $fotoPath, $comprovantePath);

if ($stmt->execute()) {
    echo '<script>
        alert("Cadastro realizado com sucesso");
        setTimeout(function() {
            window.location.href = "login.php";
        }, 500);
    </script>';
} else {
    die("Erro ao cadastrar: " . $stmt->error);
}


$stmt->close();
$mysqli->close();

?>