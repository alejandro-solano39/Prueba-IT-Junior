<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No autenticado']);
    http_response_code(401);
    exit;
}

require_once './config.php';
require_once '../src/models/User.php';

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'read':
            $stmt = $pdo->query("SELECT id, nombre, email FROM users");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['data' => $users]);
            break;

        case 'create':
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['nombre'], $data['email'], $data['password'])) {
                throw new Exception("Datos incompletos para crear el usuario");
            }

            $stmt = $pdo->prepare("INSERT INTO users (nombre, email, password) VALUES (?, ?, ?)");
            $stmt->execute([
                $data['nombre'],
                $data['email'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            echo json_encode(['message' => 'Usuario creado correctamente']);
            http_response_code(201);
            break;

        case 'getUser':
            if (!isset($_GET['id'])) {
                throw new Exception("ID de usuario no proporcionado");
            }

            $userId = (int) $_GET['id'];

            $stmt = $pdo->prepare("SELECT id, nombre, email FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo json_encode(['data' => $user]);
            } else {
                throw new Exception("Usuario no encontrado");
            }
            break;

        case 'update':
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['id'], $data['nombre'], $data['email'])) {
                throw new Exception("Datos incompletos para actualizar el usuario");
            }

            $stmt = $pdo->prepare("UPDATE users SET nombre = ?, email = ? WHERE id = ?");
            $stmt->execute([
                $data['nombre'],
                $data['email'],
                $data['id']
            ]);

            echo json_encode(['message' => 'Usuario actualizado']);
            break;

        case 'delete':
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data['id'])) {
                throw new Exception("ID no especificado para eliminación");
            }

            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$data['id']]);
            echo json_encode(['message' => 'Usuario eliminado']);
            break;

        default:
            throw new Exception("Acción no válida");
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    http_response_code(500);
}
