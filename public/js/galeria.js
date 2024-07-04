let imgMuestra = document.getElementsByClassName('img-galeria');

for (let index = 0; index < imgMuestra.length; index++) {
    imgMuestra[index].addEventListener('click', cambiarImagen);
}

function cambiarImagen() {
    let imgPrincipal = document.getElementById('produc-img');
    imgPrincipal.setAttribute('src', this.getAttribute('src'));  
}