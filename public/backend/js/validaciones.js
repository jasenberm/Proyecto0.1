function esCedulaValida(cedula) {
    cedula = String(cedula);
    cedula = cedula.split("");

    var digitoVerificador = 0;
    var decenaSuperior = 0;
    var sumaProductos = 0;

    if (cedula.length == 10) {
        var digitosUnoAlTres = new RegExp("([0][1-9]|[1][0-9]|[2][0-4])[0-5]");
        var digitosUnoAlTresValidos = digitosUnoAlTres.test(
            cedula[0] + cedula[1] + cedula[2]
        );
        if (digitosUnoAlTresValidos) {
            cedula.forEach(function(valor, indice) {
                if (indice < 9) {
                    if (indice == 0 || indice % 2 == 0) {
                        producto = parseInt(valor) * 2;
                    } else {
                        producto = parseInt(valor);
                    }
                    if (producto > 9) {
                        producto -= 9;
                    }
                    sumaProductos += parseInt(producto);
                }
            });
            if (sumaProductos > 9) {
                var arrayDecenaSuperior = String(sumaProductos).split("");
                decenaSuperior = (parseInt(arrayDecenaSuperior[0]) + 1) * 10;
            } else {
                decenaSuperior = 10;
            }
            digitoVerificador =
                parseInt(decenaSuperior) - parseInt(sumaProductos);
            if (digitoVerificador == 10) {
                digitoVerificador = 0;
            }
            if (digitoVerificador == cedula[9]) {
                // console.log('Cédula válida');
                return true;
            } else {
                // console.log('Cédula inválida');
                return false;
            }
        } else {
            // console.log('Cédula inválida. No tiene 10 digitos');
            return false;
        }
    }
}

function esFechaValida(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if (!dateString.match(regEx)) return false; //formato inválido
    var d = new Date(dateString);
    if (!d.getTime() && d.getTime() !== 0) return false; // fecha inválida
    return d.toISOString().slice(0, 10) === dateString;
}

/**
 * [isEmpty description]
 * Verifica si un objeto está vacío
 * @param  {[javascript object]}  obj [Objeto a evaluar]
 * @return {Boolean}     [true si el objeto está vacio, false si tiene contenido]
 */
function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) return false;
    }
    return true;
}

function mostrarError(array_error, elemento, contadorError) {
    var nombreElemento = elemento.getAttribute("name");
    var mensajeError = "";
    // se agrega/remueve la clase error y añade/quita un valor al contador de errores
    if (array_error[0]) {
        contadorError++;

        if (elemento.classList.contains("select2")) {
            // falta asignar error dentro
        } else {
            elemento.classList.add("error");
            elemento.classList.add("errorBorde");
        }
        mensajeError = array_error[1];
        $("#" + nombreElemento + "_info").html(
            `<label data-toggle="tooltip" title="` +
                mensajeError +
                `"><i class="fa fa-info-circle"></i></label>`
        );
        /* <!-- PERMITE MOSTRAR TOOLTIPS DE BOOTSTRAP --> */
        $('[data-toggle="tooltip"]').tooltip();
        /* <!-- PERMITE CAMBIAR EL COLOR DEL TOOLTIP A COLOR ROJO --> */
        $('label[data-toggle="tooltip"]').hover(function() {
            $(".tooltip-inner").css("background-color", "#d9534f");
            $(".tooltip-arrow").css("border-top-color", "#d9534f");
        });
    } else {
        if (elemento.classList.contains("select2")) {
            // falta asignar error dentro
        } else {
            elemento.classList.remove("error");
            elemento.classList.remove("errorBorde");
        }
        mensajeError = "";
        $("#" + nombreElemento + "_info").html(``);
    }
    return contadorError;
}

/**
 * [radioSeleccionado description]
 * @param  {[string]} radioButtonName [nombre del radio button]
 * @return {[bool]}                   [true si ha seleccionado una opción, false si no ha seleccionado ninguno]
 */
function radioSeleccionado(radioButtonName) {
    if (
        $("input[type=radio][name=" + radioButtonName + "]:checked").length > 0
    ) {
        return true;
    }
    return false;
}

// ===========================================================================================================================
// FUNCION DINAMICA QUE VALIDA TODAS LAS REGLAS ENVIADAS AL INPUT
// ===========================================================================================================================
function validarElemento(elemento) {
    var tieneError = false;
    var numeroErrores = 0;
    var mensajeError = "Este campo {y}";
    var validaciones = elemento.getAttribute("validacion").split("|");

    var cantidad = 0; // solo en caso que sea max o min la validacion

    for (var i = 0; i < validaciones.length; i++) {
        var val = validaciones[i];

        if (val == "required") {
            // siempre valida si es o no requerido
            if (elemento.value.trim().length == 0) {
                numeroErrores++;
                mensajeError = mensajeError.replace(
                    "{y}",
                    "no puede estar vacío."
                );
            }
            //break;
        } else if (val.substring(0, 3) == "max") {
            // solo para max
            cantidad = validaciones[i]
                .substring(4, validaciones[i].length)
                .replace(")", "");
            if (elemento.value.length > cantidad) {
                numeroErrores++;
                mensajeError = mensajeError.replace(
                    "{y}",
                    " máximo " + cantidad + " caracteres."
                );
            }
            //break;
        } else if (val.substring(0, 3) == "min") {
            // solo para min
            cantidad = validaciones[i]
                .substring(4, validaciones[i].length)
                .replace(")", "");
            if (elemento.value.length < cantidad || elemento.value == 0) {
                numeroErrores++;
                mensajeError = mensajeError.replace(
                    "{y}",
                    "mínimo " + cantidad + " caracteres."
                );
            }
            //break;
        } else {
            // las demas validaciones
            switch (val) {
                case "alpha":
                    if (!elemento.value.match(/^[a-zA-ZáéíóúÁÉÍÑÓÚÜ]*$/i)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres alfabéticos. No acepta espacios."
                        );
                    }
                    break;

                case "alpha_spaces":
                    if (!elemento.value.match(/^[a-zA-ZáéíóúÁÉÍÑÓÚÜ\s]*$/i)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres alfabéticos y espacios."
                        );
                    }
                    break;

                case "alpha_num":
                    if (!elemento.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÑÓÚÜ]*$/i)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres alfanuméricos."
                        );
                    }
                    break;

                case "alpha_num_spaces":
                    if (
                        !elemento.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÑÓÚÜ\s]*$/i)
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres alfanuméricos y espacios."
                        );
                    }
                    break;
                case "combo":
                    if (
                        elemento.selectedIndex <= 0 ||
                        elemento.selectedIndex == null
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "tiene que tener un item seleccionado."
                        );
                    }
                    break;

                case "date":
                    // if(!elemento.value.match(/^(0[1-9]|[12]\d|3[01])[\-](0[1-9]|1[0-2])[\-](19|20)\d{2}$/gm)) {
                    if (!esFechaValida(elemento.value)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "no tiene formato de fecha yyyy-mm-dd."
                        );
                    }
                    break;

                case "email":
                    // if(!elemento.value.match(/^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/igm)) {
                    //if (!elemento.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,6}$|^$/)) {
                    if (
                        !elemento.value.match(
                            /^([-\w\.])+@\w+\.([a-z]{1,3})\.?([a-z]{1,3})$|^$/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "no tiene formato de correo electrónico."
                        );
                    }
                    break;

                case "num":
                    if (!elemento.value.match(/^[0-9]*$/i)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres numéricos."
                        );
                    }
                    break;

                case "num_decimal":
                    if (!elemento.value.match(/^[0-9]+(.[0-9]{1,4})?$/)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres numéricos con hasta cuatro decimales separados por punto."
                        );
                    }
                    break;

                case "num_mil_decimal":
                    //if(!elemento.value.match(/^[0-9]+(.[0-9]{1,4})?$/)) {
                    if (
                        !elemento.value.match(
                            /^[0-9]+((,[0-9]{1,4})+(.[0-9]{1,4}))?$/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo puede contener caracteres numéricos con hasta cuatro decimales separados por punto."
                        );
                    }
                    break;

                case "placa_vehiculo":
                    if (!elemento.value.match(/[a-zA-Z]{3}-[0-9]{4}/)) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "es de tipo placa vehicular y debe constar de 3 letras guion (-) 4 números."
                        );
                    }
                    break;

                case "anychar":
                    if (
                        !elemento.value.match(
                            /(^[A-Za-z0-9#-_.\u00C0-\u017F\s]*$)+/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo permite letras, espacios, números, punto, numeral, y guión medio o bajo."
                        );
                    }
                    break;

                case "alpha_num_underscore":
                    if (
                        !elemento.value.match(
                            /(^[A-Za-z0-9-_\u00C0-\u017F]*$)+/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo permite letras, números y guión medio o bajo."
                        );
                    }
                    break;
                case "password":
                    if (
                        !elemento.value.match(
                            /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "Debe contener MAYUSCULA, minuscula, caracter especial y Numero Ejemplo: Ingenier@2020"
                        );
                    }
                    break;

                case "formula":
                    console.log(elemento);
                    console.log(elemento.value);
                    if (
                        !elemento.value.match(
                            /^([\+\-\*\/]?[\(]?[N|C]([2][0-5]|[1][0-9]|[0-9]){1}[\)]?)*/
                        )
                    ) {
                        numeroErrores++;
                        mensajeError = mensajeError.replace(
                            "{y}",
                            "sólo permite 'N1' a 'N25' y 'C1' a 'C25', operadores aritméticos '+ - * /' y signos de agrupación '( )' "
                        );
                    }
                    break;
            }
        }
    }
    tieneError = numeroErrores > 0 ? true : false;
    var array_error = [tieneError, mensajeError];
    return array_error;
}

// ===========================================================================================================================
// FUNCION DINAMICA QUE VALIDA EL FORMULARIO COMPLETO
// ===========================================================================================================================
function validarFormulario(formulario) {
    var array_error = []; // arreglo del boolean si tiene error[0] y el mensaje de error[1]
    var contadorError = 0; // contador de errores, si al final es 0 no hay errores
    var mensajeError = "";
    // recorremos todos los elementos con propiedad 'validacion'
    for (var i = 0; i < formulario.length; i++) {
        var elemento = formulario.elements[i];

        if (elemento.hasAttribute("validacion")) {
            array_error = validarElemento(elemento);
            var nombreElemento = elemento.getAttribute("name");

            // se agrega/remueve la clase error y añade/quita un valor al contador de errores
            if (array_error[0]) {
                contadorError++;

                if (elemento.classList.contains("select2")) {
                    // falta asignar error dentro
                } else {
                    elemento.classList.add("error");
                    elemento.classList.add("errorBorde");
                }
                mensajeError = array_error[1];
                $("#" + nombreElemento + "_info").html(
                    `<label data-toggle="tooltip" title="` +
                        mensajeError +
                        `"><i class="fa fa-info-circle"></i></label>`
                );
                /* <!-- PERMITE MOSTRAR TOOLTIPS DE BOOTSTRAP --> */
                $('[data-toggle="tooltip"]').tooltip();
                /* <!-- PERMITE CAMBIAR EL COLOR DEL TOOLTIP A COLOR ROJO --> */
                $('label[data-toggle="tooltip"]').hover(function() {
                    $(".tooltip-inner").css("background-color", "#d9534f");
                    $(".tooltip-arrow").css("border-top-color", "#d9534f");
                });
            } else {
                if (elemento.classList.contains("select2")) {
                    // falta asignar error dentro
                } else {
                    elemento.classList.remove("error");
                    elemento.classList.remove("errorBorde");
                }
                mensajeError = "";
                $("#" + nombreElemento + "_info").html(``);
            }
        }
    }

    // ==========================================================================
    // Validacion para los checkbox
    // ==========================================================================

    var divs = formulario.getElementsByTagName("div");
    for (let i = 0; i < divs.length; i++) {
        if (divs[i].hasAttribute("validachk")) {
            var divChk = divs[i];
            var minimo = divChk
                .getAttribute("validaChk")
                .replace("check", "")
                .replace("(", "")
                .replace(")", "");

            var contador = 0;
            var hijos = divChk.children;
            hijos = hijos[0];
            nombreElemento = hijos.getAttribute("name");
            hijos = hijos.children;
            for (var j = 0; j < hijos.length; j++) {
                var nietos = hijos[j].children;
                for (var k = 0; k < nietos.length; k++) {
                    // Valida que esten checked
                    if (nietos[k].checked) {
                        contador++;
                    }
                }
            }
            if (contador < minimo) {
                // error en minimo de checked
                mensajeError =
                    "Debe seleccionar al menos " + minimo + " un elemento.";
                //divChk.classList.add("error");
                $("#" + nombreElemento + "_info").html(
                    `<label title="` +
                        mensajeError +
                        `"><i class="fa fa-info-circle"></i></label>`
                );
                contadorError++;
            } else {
                divChk.classList.remove("error");
                $("#" + nombreElemento + "_info").html(``);
            }
        }
    }
    return contadorError;
}
