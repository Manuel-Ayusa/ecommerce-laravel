// sidebar
if (sidebar.classList.contains('active')) {
    contenido.classList.add('sidebar-active');
}

let btnToggle = document.getElementById('sidebar-btn');
btnToggle.addEventListener('click', mostrarOcultarSidebar);

function mostrarOcultarSidebar() {
    let sidebar = document.getElementById('sidebar');
    let contenido = document.getElementById('contenido');
    sidebar.classList.toggle('active');

    if (sidebar.classList.contains('active')) {
        contenido.classList.add('sidebar-active');
    } else {
        contenido.classList.remove('sidebar-active');
    }
}
