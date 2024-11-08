# Gestión de Usuarios

Esta es una aplicación web para la administración de usuarios, que permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) mediante una interfaz amigable y responsive. La aplicación utiliza tecnologías como PHP, MySQL, JavaScript (jQuery), Tailwind CSS, y SweetAlert2 para mejorar la experiencia del usuario.

## Requisitos Previos

1. **Servidor Web**: Se recomienda usar [XAMPP](https://www.apachefriends.org/) o [WAMP](https://www.wampserver.com/) para ejecutar un servidor Apache local con PHP y MySQL.
2. **PHP**: Versión 7.4 o superior.
3. **MySQL**: Base de datos MySQL para almacenar la información de usuarios.

## Instalación

### Paso 1: Clonar el Repositorio

Clona el repositorio en tu máquina local o descarga el código fuente.

git clone https://github.com/alejandro-solano39/Prueba-IT-Junior.git
cd Prueba-IT-Junior

### Paso 2: Configurar la Base de Datos
Abre el gestor de bases de datos de MySQL (phpMyAdmin en XAMPP o el cliente que prefieras).
Crea una nueva base de datos, por ejemplo, llamada gestion_usuarios.
Importa el archivo SQL para crear la tabla necesaria. Puedes hacer esto ejecutando el siguiente SQL:

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
);

### Paso 3: Configurar la Conexión a la Base de Datos
Abre el archivo config.php en el directorio raíz de tu proyecto.
Asegúrate de que los parámetros de conexión a la base de datos sean correctos. Actualiza los valores de DB_HOST, DB_NAME, DB_USER, y DB_PASSWORD según tu configuración local.

// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'prueba_it_junior'); // Nombre de la base de datos
define('DB_USER', 'root');             // Usuario de MySQL
define('DB_PASSWORD', '');             // Contraseña de MySQL

### Paso 4: Configurar el Servidor Web
Si estás usando XAMPP, coloca la carpeta del proyecto en el directorio htdocs. Si es WAMP, colócala en www.
Accede a la aplicación en tu navegador: http://localhost/Prueba-IT-Junior/public/.

## Ejecución
Inicia Apache y MySQL en XAMPP o WAMP.
Abre el navegador y visita http://localhost/prueba_it_junior/public/ para ver la aplicación en funcionamiento.

## Uso
Agregar Usuario: Haz clic en el botón "Agregar Usuario" para abrir el modal de creación de usuario, completa los campos y guarda el nuevo usuario.

Editar Usuario: En la tabla de usuarios, haz clic en "Editar" para modificar los detalles del usuario seleccionado.

Eliminar Usuario: En la tabla de usuarios, haz clic en "Eliminar" para borrar un usuario. Aparecerá un mensaje de confirmación.

Cerrar Sesión: Haz clic en el botón de "Cerrar Sesión" en la parte superior para salir de la sesión.

## Funcionamiento General de la API
La API está diseñada de manera que cada solicitud desde el cliente (interfaz de usuario) se traduce en una acción específica en la base de datos. El sistema utiliza métodos HTTP y endpoints específicos para determinar qué acción realizar y cómo manejar la información.

Cada solicitud sigue un ciclo general:

Solicitudes desde el Cliente: Se realiza una solicitud HTTP con un parámetro action en la URL (por ejemplo, ?action=read).
Validación y Autenticación: La API verifica si el usuario está autenticado y si la solicitud contiene todos los datos necesarios.
Lógica del Servidor: El servidor maneja la solicitud en función de la acción indicada en la URL.
Respuesta en JSON: La API responde con un mensaje en formato JSON, que el cliente utiliza para actualizar la interfaz sin recargar la página.

## Endpoints y Funciones de la API
A continuación se detallan las funciones específicas de cada endpoint de la API:
Obtener todos los usuarios:

### Método HTTP: GET
Endpoint: /api.php?action=read
Función: Lee todos los usuarios de la base de datos y devuelve una lista en formato JSON.
### Ejemplo de Respuesta:

{
"data":[
      {
      "id":"9",
      "nombre":"Cesar Alejandro ",
      "email":"csolano3@ucol.mx"},
      {
      "id":"22",
      "nombre":"ELIDIA",
      "email":"csolano333@ucol.mx"
      }
      ]
}

### Obtener un usuario específico:
Método HTTP: GET
Endpoint: /api.php?action=getUser&id=id
Función: Obtiene los detalles de un usuario específico mediante su ID.

### Ejemplo de Respuesta:
{
    "data": {
        "id": "1",
        "nombre": "ELIDIA",
        "email": "csolano333@ucol.mx"
    }
}

### Crear un nuevo usuario:

Método HTTP: POST
Endpoint: /api.php?action=create
Función: Crea un nuevo usuario con los datos enviados en el cuerpo de la solicitud (nombre, email y contraseña).
### Ejemplo de Datos de Entrada:
{
  "nombre": "Carlos Carlos",
  "email": "carlos@gamil.com",
  "password": "123456"
}
### Ejemplo de Respuesta Exitosa:
{
    "message": "Usuario creado correctamente"
}

### Actualizar un usuario:

Método HTTP: POST
Endpoint: /api.php?action=update
Función: Actualiza los datos de un usuario existente en la base de datos.
### Ejemplo de Datos de Entrada:
{
  "id": 22,
  "nombre": "Juan Pérez Actualizado",
  "email": "juan.actualizado@example.com"
}

### Ejemplo de Respuesta Exitosa:
{
    "message": "Usuario actualizado"
}

### Eliminar un usuario:

Método HTTP: POST
Endpoint: /api.php?action=delete
Función: Elimina el usuario con el ID especificado.
### Ejemplo de Datos de Entrada
{
  "id": 22
}
### Ejemplo de Respuesta Exitosa:
{
    "message": "Usuario eliminado"
}

## Flujo de la API en la Interfaz
Carga Inicial: La aplicación llama a GET /api.php?action=read para obtener y mostrar todos los usuarios.

Creación de Usuario: Al hacer clic en "Agregar Usuario", el formulario envía los datos mediante POST /api.php?action=create.

Edición de Usuario: Al hacer clic en "Editar", la aplicación llama a GET /api.php?action=getUser&id={id} para cargar los datos en el formulario de edición.

Actualización: El formulario de edición envía los cambios con POST /api.php?action=update.

Eliminación de Usuario: Al confirmar la eliminación, se envía POST /api.php?action=delete con el ID del usuario.

## Tecnologías Usadas
HTML: Estructura de la interfaz de usuario.

CSS y Tailwind CSS: Estilos y diseño responsivo.

JavaScript y jQuery: Interactividad y validación en el cliente.

SweetAlert2: Alertas visuales de éxito, error y confirmación.

PHP: Lógica de servidor y procesamiento de solicitudes.

MySQL: Almacenamiento de datos en base de datos relacional.

Font Awesome: Iconos para botones y elementos visuales.

## Notas
Asegúrate de tener activadas las extensiones PDO y MySQL en tu configuración de PHP (php.ini).

Esta aplicación utiliza sesiones para la autenticación básica.
