//Formulario Order Envio
let input = document.getElementById('env');
let costoTotal = document.getElementById('costoTotal');
input.addEventListener('click', mostrarFormulario);


function mostrarFormulario() {
    let form = document.getElementById('formEnv');
    let costoCarrito = document.getElementById('preCarr');

    form.innerHTML = '<fieldset><legend><b>Detalles de Envio</b></legend><label for="prov">Provincia</label><input type="text" name="provincia" id="prov" class="form-control" required ><label for="loc">Localidad</label><input type="text" name="localidad" id="loc" class="form-control" required><label for="calle">Calle</label><input type="text" name="calle" id="calle" class="form-control" required><label for="num">Numero</label><input type="number" name="numero" min=1 id="num" class="form-control" required><label for="cod">Codigo Postal</label><input type="number" name="CP" min=1 id="cod" class="form-control" required><p class="pt-2 fs-4"><b>Costo de envio: $2000.00</b></p></fieldset>';

    costoTotal.innerHTML = '<b>Total: $' + (parseFloat(costoCarrito.value) + parseFloat(2000)).toFixed(2) + '</b>';
}

let input2 = document.getElementById('ret');
input2.addEventListener('click', ocultarFormulario);

function ocultarFormulario() {
    let form = document.getElementById('formEnv');
    form.innerHTML = '';
    let costoCarrito = document.getElementById('preCarr');

    costoTotal.innerHTML = '<b>Total: $' + costoCarrito.value.toFixed(2) + '</b>';
}




