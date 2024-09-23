
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>
<script src="../assets/vendor/js/template-customizer.js"></script>
<script>
const darkModeToggle = document.getElementById('flexSwitchCheckDefault');
const body = document.body;
const darkModeKey = 'darkMode';

// Función para verificar si el modo oscuro está activado
function isDarkModeEnabled() {
  return localStorage.getItem(darkModeKey) === 'true';
}

// Función para activar o desactivar el modo oscuro
function toggleDarkMode() {
  body.classList.toggle('dark-mode');

  if (body.classList.contains('dark-mode')) {
    localStorage.setItem(darkModeKey,   
 'true');
  } else {
    localStorage.removeItem(darkModeKey);
  }
}

// Inicializar el modo oscuro si está almacenado
if (isDarkModeEnabled()) {
  body.classList.add('dark-mode');
  darkModeToggle.checked = true;
}

darkModeToggle.addEventListener('change', toggleDarkMode);
</script>

