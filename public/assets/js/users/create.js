//CONTRASEÑAS VIEW ICON
document.addEventListener('DOMContentLoaded', function () {
    // Función para alternar la visibilidad de la contraseña

});



//VALIDACION DE CONTRASEÑAS
document.addEventListener('DOMContentLoaded', function() {
    function togglePasswordVisibility() {
        let passwordInput = document.getElementById('password');
        let passwordIcon = document.getElementById('togglePassword').getElementsByTagName('i')[0];

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
    // Agregar listener al campo de contraseña
    document.getElementById('password').addEventListener('keyup', habilitarConfirmacion);

    // Deshabilitar el campo de confirmación de contraseña inicialmente
    document.getElementById('confirm_password').disabled = true;
});

// Función para habilitar el campo de confirmación de contraseña
function habilitarConfirmacion() {
    let password = document.getElementById('password').value;
    let confirm_password_field = document.getElementById('confirm_password');

    if (validarPassword(password)) {
        confirm_password_field.disabled = false;
        confirm_password_field.addEventListener('keyup', validarContraseñas);
    } else {
        confirm_password_field.disabled = true;
    }
}

// Función para validar la contraseña
function validarPassword(password) {
    let regex = /^(?=.*[!@#\$%\^&\*])(?=.*[A-Z])(?=.{8,})/;
    let mensajeValidacion = document.getElementById('mensaje-validacion');

    if (!regex.test(password)) {
        mensajeValidacion.textContent = 'La contraseña debe tener al menos 8 caracteres, 1 mayúscula y contener al menos un carácter especial.';
        mensajeValidacion.style.color = 'red';
        return false;
    } else {
        mensajeValidacion.textContent = 'Contraseña válida.';
        mensajeValidacion.style.color = 'green';
        return true;
    }
}

// Función para validar que las contraseñas coincidan
function validarContraseñas() {
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;
    let mensajeConfirmacion = document.getElementById('mensaje-confirmacion');

    if (password === confirm_password) {
        mensajeConfirmacion.textContent = 'Las contraseñas coinciden.';
        mensajeConfirmacion.style.color = 'green';
    } else {
        mensajeConfirmacion.textContent = 'Las contraseñas no coinciden.';
        mensajeConfirmacion.style.color = 'red';
    }
}
