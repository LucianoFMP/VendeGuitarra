<?php 
session_start();
include("conexao.php");

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $produto_id = intval($_POST['id']);
    $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id] += $quantidade;
    } else {
        $_SESSION['carrinho'][$produto_id] = $quantidade;
    }

    print_r($_SESSION['carrinho']);

    setcookie('carrinho', serialize($_SESSION['carrinho']), time() + (86400 * 7), "/");

    header("Location: carrinho.php");
    exit();
} else {
    header("Location: homepage.php");
    exit();
}