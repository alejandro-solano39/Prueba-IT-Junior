<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_name = $_SESSION['user_name'] ?? 'Usuario';

require_once __DIR__ . './config.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

$controller = new UserController($pdo);

include '../src/views/header.php';
?>

<!-- Contenedor Principal -->
<main class="min-h-screen bg-[#F3F8FB] p-4 flex flex-col items-center justify-start">

    <header class="w-full max-w-3xl bg-[#4C647C] rounded-md shadow-sm p-5 mb-8 flex flex-col md:flex-row items-center justify-between">
        <h1 class="text-xl font-medium text-white text-center md:text-left">Administración de Usuarios</h1>

        <nav class="flex items-center space-x-4 mt-3 md:mt-0">
            <span class="text-white font-medium text-sm">Hola, <?php echo htmlspecialchars($user_name); ?></span>
            <a href="../auth/logout.php" class="inline-flex items-center px-4 py-2 bg-[#F87171] hover:bg-[#E63946] text-white text-sm font-medium rounded-md shadow-sm">
                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
            </a>
        </nav>
    </header>

    <section aria-label="Agregar Usuario">
        <button id="openUserModalButton" class="fixed bottom-5 right-5 bg-[#3AAFA9] hover:bg-[#2B7A78] text-white font-medium p-4 rounded-full shadow-md flex items-center justify-center md:relative md:bottom-0 md:right-0 md:p-3 md:rounded-md mb-6">
            <i class="fas fa-plus mr-2"></i>
            <span class="hidden md:inline">Agregar Usuario</span>
        </button>
    </section>

    <section class="w-full max-w-3xl rounded-md overflow-hidden" aria-labelledby="userTableTitle">
        <h2 id="userTableTitle" class="sr-only">Tabla de Usuarios</h2>
        <?php include '../src/views/user-list.php'; ?>
    </section>
</main>

<?php
include '../src/views/user-modal.php'; // Modal para crear/editar usuarios
include '../src/views/footer.php';
?>
