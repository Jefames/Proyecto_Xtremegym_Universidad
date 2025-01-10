// validacion.js
document.addEventListener('DOMContentLoaded', function() {

    //USUARIO
    var usuarioInput = document.getElementById('usuario');
    if (usuarioInput) {
        usuarioInput.addEventListener('input', function (e) {
            // Reemplazar cualquier carácter que no sea un número con una cadena vacía
            this.value = this.value.replace(/[^0-9]/g, '');

            // Truncar la entrada a un máximo de 6 dígitos
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });

    //CONTRASEÑA
        // Obtén el campo de contraseña y el botón del ojito
        var passwordInput = document.getElementById("password");
        var botonOjito = document.getElementById("boton_ojito");

        // Inicialmente, oculta el botón del ojito
        botonOjito.style.display = 'none';

        // Event listener para el campo de contraseña
        passwordInput.addEventListener('input', function() {
            if (this.value) {
                botonOjito.style.display = 'block'; // Muestra el botón si hay texto
            } else {
                botonOjito.style.display = 'none'; // Oculta el botón si el campo está vacío
            }
        });

    }

    document.getElementById('boton_ojito').addEventListener('click', togglePasswordVisibility);
});

// Función para alternar la visibilidad de la contraseña
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePasswordIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}


