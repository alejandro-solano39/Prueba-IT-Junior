$(document).ready(function () {
  const apiUrl = "http://localhost/prueba-it-junior/public/api.php";

  // Cargar usuarios al iniciar la página
  loadUsers();

  // Función para cargar usuarios en la tabla desde la API
  function loadUsers() {
    $.ajax({
      url: `${apiUrl}?action=read`,
      method: "GET",
      dataType: "json", // Forzamos JSON
      success: function (response) {
        if (response && response.data) {
          $("#userTable").empty();
          response.data.forEach(function (user) {
            $("#userTable").append(`
                <tr class="border-b border-gray-200 hover:bg-[#EAF0F4] transition-colors">
                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">${user.id}</td>
                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">${user.nombre}</td>
                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">${user.email}</td>
                <td class="py-4 px-6 text-sm flex space-x-2 items-center">
                <!-- Botón de Editar Usuario -->
                <button onclick="editUser(${user.id})" class="flex items-center space-x-1 bg-[#3AAFA9] hover:bg-[#2B7A78] text-white font-medium py-1 px-3 rounded-md transition-colors duration-150">
                <i class="fas fa-edit"></i>
                <span>Editar</span>
                </button>
                <!-- Botón de Eliminar Usuario -->
                <button onclick="confirmDelete(${user.id})" class="flex items-center space-x-1 bg-[#F87171] hover:bg-[#E63946] text-white font-medium py-1 px-3 rounded-md transition-colors duration-150">
                <i class="fas fa-trash-alt"></i>
                <span>Eliminar</span>
                </button>
                </td>
                </tr>
                `);
          });
        } else {
          console.error("Error: Respuesta no contiene datos de usuario.");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo cargar la lista de usuarios.",
        });
      },
    });
  }

  // Mostrar el modal para crear un nuevo usuario
  $("#openUserModalButton").on("click", function () {
    $("#modalTitle").text("Crear Usuario");
    $("#userId").val("");
    $("#nombre").val("");
    $("#email").val("");
    $("#password").val("");
    $("#userModal").removeClass("hidden");
  });

  // Cerrar el modal de usuario
  $("#closeUserModalButton").on("click", function () {
    $("#userModal").addClass("hidden");
  });

  // Enviar el formulario de usuario (crear/editar)
  $("#userForm").on("submit", function (event) {
    event.preventDefault();

    const userId = $("#userId").val();
    const nombre = $("#nombre").val();
    const email = $("#email").val();
    const password = $("#password").val();
    const actionUrl = userId
      ? `${apiUrl}?action=update`
      : `${apiUrl}?action=create`;

    $.ajax({
      url: actionUrl,
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        id: userId,
        nombre: nombre,
        email: email,
        password: password,
      }),
      success: function (response) {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: response.message,
          timer: 2000,
          showConfirmButton: false,
        });
        $("#userModal").addClass("hidden"); 
        loadUsers();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Ocurrió un error al guardar el usuario.",
        });
        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
      },
    });
  });

  // Mostrar el modal de usuario en modo edición y cargar datos del usuario
  window.editUser = function (id) {
    $.ajax({
      url: `${apiUrl}?action=getUser`,
      method: "GET",
      data: { id: id },
      dataType: "json", 
      success: function (response) {
        if (response && response.data) {
          const user = response.data;
          $("#userId").val(user.id);
          $("#nombre").val(user.nombre);
          $("#email").val(user.email);
          $("#password").val(""); 
          $("#modalTitle").text("Editar Usuario"); 
          $("#userModal").removeClass("hidden");
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo cargar la información del usuario.",
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Ocurrió un error al cargar los datos del usuario.",
        });
        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
      },
    });
  };

  // Confirmar eliminación de usuario
  window.confirmDelete = function (id) {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `${apiUrl}?action=delete`,
          method: "POST",
          contentType: "application/json",
          data: JSON.stringify({ id: id }),
          success: function (response) {
            Swal.fire("Eliminado", response.message, "success");
            loadUsers();
          },
          error: function (jqXHR, textStatus, errorThrown) {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Ocurrió un error al eliminar el usuario.",
            });
            console.error(
              "Error en la solicitud AJAX:",
              textStatus,
              errorThrown
            );
          },
        });
      }
    });
  };
});
