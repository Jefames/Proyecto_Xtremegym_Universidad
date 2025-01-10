document.addEventListener('DOMContentLoaded', function() {
    function validarSoloLetras(input) {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-z\s]/g, '');
            this.style.borderColor = this.value ? '' : 'red';
        });

        input.addEventListener('blur', function() {
            this.style.borderColor = this.value ? '' : 'red';
        });
    }

    function validarFechaHora(input, regex) {
        input.addEventListener('input', function() {

            if (input.type == 'date'){
                input.addEventListener('input', function() {
                    this.value = this.value.slice(0, 10); // Restringe la longitud del valor
                 //   this.value = this.value.replace(/^\d{2}-\d{2}-\d{4}$/, '');
                    this.style.borderColor = this.value ? '' : 'red';
                });
                input.addEventListener('blur', function() {
                    this.style.borderColor = this.value ? '' : 'red';
                });
            }
            if (input.type == 'time'){
                input.addEventListener('input', function() {
                    var partes = this.value.split(':');
                    if (partes.length === 2 && !isNaN(partes[1]) && parseInt(partes[1]) > 59) {
                        partes[1] = '59';
                        this.value = partes.join(':');
                    }
                    // this.value = this.value.slice(0, 5); // Restringe la longitud del valor
                    // this.value = this.value.replace(/^\d{2}:\d{2}$/, '');
                    this.style.borderColor = this.value ? '' : 'red';
                });
            }

        });

        input.addEventListener('blur', function() {
            this.style.borderColor = this.value ? '' : 'red';
        });
    }

    validarSoloLetras(document.getElementById('primer_nombre'));
    validarSoloLetras(document.getElementById('primer_apellido'));

    // Valida que la fecha tenga el formato YYYY-MM-DD
    validarFechaHora(document.getElementById('fecha',10));

    // Valida que la hora tenga el formato HH:MM
    validarFechaHora(document.getElementById('hora'));

    //VALIDACION NUMERO DE TELEFONO
    var telInput = document.getElementById('telefono');
    if (telInput) {
        telInput.addEventListener('input', function (e) {
            // Reemplazar cualquier carácter que no sea un número con una cadena vacía
            this.value = this.value.replace(/[^0-9]/g, '');

            // Truncar la entrada a un máximo de 8 dígitos
            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
            }
        });
    }

    //VALIDACION DPI NO PERMITIR LETRAS
    var telInput = document.getElementById('dpi');
    if (telInput) {
        telInput.addEventListener('input', function (e) {
            // Reemplazar cualquier carácter que no sea un número con una cadena vacía
            this.value = this.value.replace(/[^0-9]/g, '');

            // Truncar la entrada a un máximo de 8 dígitos
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });
    }


    //VALIDACION DE DESCRIPCION - LIMITACION DE CARACTERES
    var descripInput = document.getElementById('descripcion');

    if (descripInput){
        descripInput.addEventListener('input', function() {
        const maxLength = 99;
        const currentLength = this.value.length;

        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }

        document.getElementById('contador').innerText = `${currentLength} / ${maxLength+1}`;
    });
    }

    var form = document.getElementById('formularioRegistro');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var mensajeError = "Por favor, corrige los siguientes campos:\n";
        var esValido = true;

        // Verificar cada campo
        ['primer_nombre', 'apellido', 'fecha', 'hora'].forEach(function(id) {
            var input = document.getElementById(id);
            if (input.style.borderColor === 'red' || !input.value) {
                mensajeError += "- " + id + "\n";
                esValido = false;
            }
        });

        if (!esValido) {
            alert(mensajeError);
        } else {
            // Aquí el código para enviar el formulario
            // form.submit();
        }
    });
});
