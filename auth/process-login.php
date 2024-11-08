<?php
session_start();
require_once '../public/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, nombre, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        header("Location: ../public/index.php");
        exit;
    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
