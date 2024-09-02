function showNotification(containerId, title, message, type) {
  var container = document.getElementById(containerId);

  // Crear el contenedor de la alerta si no existe
  if (!container) {
    console.error(`No se encontró un contenedor con el ID "${containerId}"`);
    return;
  }

  // Eliminar alerta existente si hay una
  var existingAlert = container.querySelector(".alert");
  if (existingAlert) {
    existingAlert.classList.remove("show");
    existingAlert.classList.add("fade");
    setTimeout(function () {
      // Verificación adicional antes de remover el nodo
      if (existingAlert && existingAlert.parentNode === container) {
        container.removeChild(existingAlert);
      }
    }, 150); // Tiempo de animación de Bootstrap para el fade-out
  }

  // Crear nuevos elementos de la alerta
  var alertDiv = document.createElement("div");
  alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
  alertDiv.role = "alert";

  var alertTitle = document.createElement("strong");
  alertTitle.textContent = title;

  var alertMessage = document.createElement("span");
  alertMessage.textContent = " " + message;

  var closeButton = document.createElement("button");
  closeButton.type = "button";
  closeButton.className = "btn-close";
  closeButton.setAttribute("data-bs-dismiss", "alert");
  closeButton.setAttribute("aria-label", "Close");

  // Ensamblar la alerta
  alertDiv.appendChild(alertTitle);
  alertDiv.appendChild(alertMessage);
  alertDiv.appendChild(closeButton);

  // Agregar la alerta al contenedor
  container.appendChild(alertDiv);

  // Auto cerrar la alerta después de 5 segundos
  setTimeout(function () {
    alertDiv.classList.remove("show");
    alertDiv.classList.add("fade");
    setTimeout(function () {
      // Verificación adicional antes de remover el nodo

      if (alertDiv && alertDiv.parentNode === container) {
        container.removeChild(alertDiv);
      }
    }, 150); // Tiempo de animación de Bootstrap para el fade-out
  }, 2000); // Tiempo antes de empezar a desvanecer
}
