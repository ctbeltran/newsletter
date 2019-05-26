// Declar variables
const btnSuscribir = document.querySelector('#btnSuscribir');
const inputMail = document.querySelector('#inputMail');
const description = document.querySelector('#message');


// Declarar Funciones
const registrarUsuario = (correo) => {    
    let datos = new FormData();
    datos.append('usuario', correo)
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST','./assets/models/registrar-usuario.php', true);
    xhr.onload = function() {
        if(this.status === 200) {
            let respuesta = JSON.parse(xhr.responseText)
            if(respuesta.mensaje === 1) {
                Swal.fire({            
                    type: 'success',
                    title: '¡Correcto!',
                    text: 'Has sido registrado al newsletter exitosamente',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    description.textContent="Has sido registrado al newsletter exitosamente";
                    inputMail.style="display:none;"
                    btnSuscribir.style="display:none;"
                })
            }
        }
    }
    xhr.send(datos);
}

const validarCorreo = (correo) => {
    let emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(!correo) {
        Swal.fire({
            type: 'warning',
            title: '¡Lo siento!',
            text: 'Debes ingresar tu correo electrónico',
            showConfirmButton: false,
            timer: 2000            
        })
    } else if(emailRegex.test(correo)) {
        registrarUsuario(correo);        
    } else {
        Swal.fire({
            type: 'error',
            title: '¡Lo siento!',
            text: 'Debes ingresar una dirección de correo valida',
            showConfirmButton: false,
            timer: 2000 
        })
    }
}

const getSuscription = (e) => {
    e.preventDefault();
    let correo = inputMail.value;    
    validarCorreo(correo);
}

const cargaDocumento = () => {
    btnSuscribir.addEventListener('click', getSuscription)
}

// Asignar eventos
window.addEventListener('DOMContentLoaded', cargaDocumento)