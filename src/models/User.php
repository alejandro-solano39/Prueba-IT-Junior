<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para crear un nuevo usuario
    public function create($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (nombre, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email, $passwordHash]);
    }

    // Método para obtener todos los usuarios
    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, nombre, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un usuario por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, email FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un usuario
    public function update($id, $nombre, $email, $password = null) {
        $query = "UPDATE users SET nombre = ?, email = ?";
        $params = [$nombre, $email];

        if ($password) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password = ?";
            $params[] = $passwordHash;
        }

        $query .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }

    // Método para eliminar un usuario
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
