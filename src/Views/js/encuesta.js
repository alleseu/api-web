/*!
 * JAVASCRIPT PARA LAS FUNCIONALIDADES DE LA VISTA ENCUESTA.
 *
 * Autor: Alejandro Alberto Sánchez Iturriaga
 * Fecha: 03/10/2021
 */


var input_requerido;


//FUNCIÓN PARA ACTIVAR Y DESACTIVAR EL INPUT DEL TIEMPO.
function activarInput(booleano) {

	if (booleano) {
        $("#seccion_tiempo").show();
    }
    else {
        $("#seccion_tiempo").hide();
    }

    input_requerido = booleano;
}


//DOCUMENT.READY - EJECUTA LAS FUNCIONES UNA VEZ CARGADO EL CONTENIDO HTML DE LA PÁGINA WEB (DOM).
$(function() {

	//INICIALMENTE MANDA EL FOCUS AL INPUT DEL NOMBRE Y DESACTIVA EL INPUT DEL TIEMPO.
	$('input[name=nombre]').focus();
    activarInput(false);

    const icono_error = "<i class='fas fa-times-circle'></i>";

    //SE CONFIGURA LAS REGLAS Y MENSAJES PARA LA VALIDACIÓN DEL FORMULARIO.
    const validator = $("#formulario").validate({
        rules: {
            nombre: {
                required: true,
                rangelength: [2, 100]
            },
            genero: {
                required: true,
                range: [1, 2]
            },
            hobby: {
                required: true,
                range: [1, 11]
            },
            tiempo: {
                required: input_requerido,
                number: true,
                min: 1,
                max: 720
            }
        },
        messages: {
            nombre: {
                required: icono_error+" Ingrese un Nombre.",
                rangelength: icono_error+" Ingrese un Nombre con longitud entre 2 a 100 letras."
            },
            genero: {
                required: icono_error+" Seleccione un Género.",
                range: icono_error+" Seleccione un Género válido."
            },
            hobby: {
                required: icono_error+" Seleccione un Hobby.",
                range: icono_error+" Seleccione un Hobby válido."
            },
            tiempo: {
                required: icono_error+" Ingrese un tiempo en Horas.",
                number: icono_error+" Ingrese una Hora válida.",
                min: icono_error+" Ingrese una Hora mayor o igual a 1.",
                max: icono_error+" Ingrese una Hora menor o igual a 720."
            }
        }
    });


	//FUNCIÓN PARA ACTIVAR O DESACTIVAR EL INPUT DEL TIEMPO POR CADA SELECCIÓN DE UN HOBBY.
    $("input[name=hobby]").change(function() {
        const id = $(this).val();

        if (id == 1) {
            activarInput(false);
        }
        else {
            activarInput(true);
        }
    });


    //FUNCIÓN PARA VALIDAR LOS CAMPOS DEL FORMULARIO Y EJECUTAR EL SUBMIT SI CORRESPONDE.
    $("#boton_registrar").click(function(event) {
        event.preventDefault();

        const validacion = validator.form();

        if (validacion) {
            $("#formulario").submit();
        }
    });
});


//WINDOW.ONLOAD - EJECUTA LAS FUNCIONES UNA VEZ CARGADO TODO EL CONTENIDO HTML Y LOS RECURSOS GRAFICOS.
window.onload = function() {
    $("#spinner").addClass("d-none");  //Oculta el spinner de carga.
};
