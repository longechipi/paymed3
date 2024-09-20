const menuToggle = document.querySelector('.layout-menu-toggle');
const htmlElement = document.getElementById('colapso');
menuToggle.addEventListener('click', () => {
    if (htmlElement.classList.contains('layout-menu-fixed') && htmlElement.classList.contains('layout-menu-collapsed')) {
        htmlElement.classList.add('layout-menu-collapsed');
        localStorage.setItem('menuCollapsed', 'true');
        console.log('El elemento tiene ambas clases.');
      } else {
        htmlElement.classList.remove('layout-menu-collapsed');
        localStorage.setItem('menuCollapsed', 'false');
        console.log('El elemento no tiene ambas clases.');
      }
})

const savedState = localStorage.getItem('menuCollapsed');
if (savedState === 'true') {
    htmlElement.classList.add('layout-menu-collapsed');
}else{
    htmlElement.classList.remove('layout-menu-collapsed');
}

