<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-[#F3F8FB] p-6">

    <div class="container mx-auto p-4 w-full">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#4C647C]">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-white uppercase tracking-wider">Nombre</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-white uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="bg-white divide-y divide-gray-200 text-gray-700">
                    <!-- Filas de datos -->
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
