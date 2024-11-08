<div id="userModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50" role="dialog" aria-labelledby="modalTitle" aria-modal="true">
    <main class="bg-white w-full max-w-md mx-4 sm:mx-auto rounded-lg shadow-lg p-6" role="document">
        <header class="flex justify-between items-center mb-4">
            <h2 id="modalTitle" class="text-xl font-semibold text-[#4C647C]">Crear Usuario</h2>
            <button id="closeUserModalButton" class="text-gray-500 hover:text-gray-700 text-lg font-bold" aria-label="Cerrar modal">&times;</button>
        </header>
        <form id="userForm">
            <input type="hidden" id="userId" name="id">
            <fieldset class="mb-4">
                <legend class="sr-only">Información del usuario</legend>
                <div class="mb-4">
                    <label for="nombre" class="block text-[#4C647C] font-medium mb-2">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="border border-gray-300 rounded-lg p-2 w-full focus:border-[#3AAFA9] focus:outline-none text-gray-800" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-[#4C647C] font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded-lg p-2 w-full focus:border-[#3AAFA9] focus:outline-none text-gray-800" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-[#4C647C] font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded-lg p-2 w-full focus:border-[#3AAFA9] focus:outline-none text-gray-800" required>
                </div>
            </fieldset>
            <button type="submit" class="bg-[#3AAFA9] hover:bg-[#2B7A78] text-white font-semibold py-2 px-4 rounded-lg w-full mt-4">
                Guardar
            </button>
        </form>
    </main>
</div>
