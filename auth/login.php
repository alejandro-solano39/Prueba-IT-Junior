<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Iniciar Sesión</h2>

        <form action="process-login.php" method="POST" class="space-y-5">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Correo Electrónico</label>
                <div class="flex items-center bg-gray-100 border border-gray-300 rounded-lg">
                    <span class="px-3 text-gray-500"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" placeholder="usuario@ejemplo.com"
                        class="w-full px-4 py-3 bg-gray-100 rounded-r-lg focus:border-gray-500 focus:bg-white focus:outline-none transition duration-150" required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Contraseña</label>
                <div class="flex items-center bg-gray-100 border border-gray-300 rounded-lg">
                    <span class="px-3 text-gray-500"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" placeholder="********"
                        class="w-full px-4 py-3 bg-gray-100 rounded-r-lg focus:border-gray-500 focus:bg-white focus:outline-none transition duration-150" required>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 flex items-center justify-center space-x-2 rounded-lg bg-gray-800 hover:bg-gray-900 text-white font-medium transition duration-150">
                <i class="fas fa-sign-in-alt"></i>
                <span>Iniciar Sesión</span>
            </button>
        </form>
    </div>

</body>

</html>