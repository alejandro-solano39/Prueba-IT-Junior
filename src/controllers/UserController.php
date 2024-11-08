<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function createUser($nombre, $email, $password)
    {
        if ($this->userModel->create($nombre, $email, $password)) {
            return ['success' => true, 'message' => 'Usuario creado exitosamente'];
        }
        return ['success' => false, 'message' => 'Error al crear usuario'];
    }

    public function getAllUsers()
    {
        return $this->userModel->getAll();
    }

    public function getUserById($id)
    {
        return $this->userModel->getById($id);
    }

    public function updateUser($id, $nombre, $email, $password = null)
    {
        if ($this->userModel->update($id, $nombre, $email, $password)) {
            return ['success' => true, 'message' => 'Usuario actualizado exitosamente'];
        }
        return ['success' => false, 'message' => 'Error al actualizar usuario'];
    }

    public function deleteUser($id)
    {
        if ($this->userModel->delete($id)) {
            return ['success' => true, 'message' => 'Usuario eliminado exitosamente'];
        }
        return ['success' => false, 'message' => 'Error al eliminar usuario'];
    }
}
