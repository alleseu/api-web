/*!
 * JAVASCRIPT PARA LAS FUNCIONALIDADES DE LA VISTA REPORTE.
 *
 * Autor: Alejandro Alberto Sánchez Iturriaga
 * Fecha: 04/10/2021
 */


//FUNCIÓN PARA GENERAR UN NÚMERO ALEATORIO.
function generarNumero(numero) {
	return (Math.random()*numero).toFixed(0);
}


//FUNCIÓN PARA GENERAR UN COLOR RGB ALEATORIO.
function generarColorRGB() {
	var coolor = "("+generarNumero(255)+","+generarNumero(255)+","+generarNumero(255)+")";
	return "rgb" + coolor;
}


//FUNCIÓN PARA GENERAR EL GRÁFICO CORRESPONDIENTE A LA PREGUNTA 1 DE LA ENCUESTA.
function generarGrafico1(data) {
    const nombres = [];
    const cantidades = [];
    const colores = [];
    data.forEach(element => {
        nombres.push(element.nombre);
        cantidades.push(element.cantidad);
        colores.push(generarColorRGB());
    });

    const ctx = document.getElementById('grafico1');
    const config = {
        type: 'doughnut',
        data: {
            labels: nombres,
            datasets: [{
              label: 'Cantidad de Nombres',
              data: cantidades,
              backgroundColor: colores,
              hoverOffset: 4
            }]
        }
    };
    const grafico1 = new Chart(ctx, config);
}


//FUNCIÓN PARA GENERAR EL GRÁFICO CORRESPONDIENTE A LA PREGUNTA 2 DE LA ENCUESTA.
function generarGrafico2(data) {
    const generos = [];
    const cantidades = [];
    const colores1 = [];
    const colores2 = [];
    data.forEach(element => {
        generos.push(element.genero);
        cantidades.push(element.cantidad);
        colores1.push(generarColorRGB());
        colores2.push(generarColorRGB());
    });

    const ctx = document.getElementById('grafico2');
    const config = {
        type: 'bar',
        data: {
            labels: generos,
            datasets: [{
                label: 'Cantidad de Géneros',
                data: cantidades,
                backgroundColor: colores1,
                borderColor: colores2,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const grafico2 = new Chart(ctx, config);
}


//FUNCIÓN PARA GENERAR EL GRÁFICO CORRESPONDIENTE A LA PREGUNTA 3 DE LA ENCUESTA.
function generarGrafico3(data) {
    const hobbys = [];
    const cantidades = [];
    data.forEach(element => {
        hobbys.push(element.hobby);
        cantidades.push(element.cantidad);
    });

    const ctx = document.getElementById('grafico3');
    const config = {
        type: 'line',
        data: {
            labels: hobbys,
            datasets: [{
                label: 'Cantidad de tiempos (Horas)',
                data: cantidades,
                fill: false,
                borderColor: generarColorRGB(),
                tension: 0.1
            }]
        }
    };
    const grafico3 = new Chart(ctx, config);
}


//FUNCIÓN PARA GENERAR EL GRÁFICO CORRESPONDIENTE A LA PREGUNTA 4 DE LA ENCUESTA.
function generarGrafico4(data) {
    const hobbys = [];
    const tiempos_promedios = [];
    const colores = [];
    data.forEach(element => {
        hobbys.push(element.hobby);
        tiempos_promedios.push(element.tiempo_promedio);
        colores.push(generarColorRGB());
    });

    const ctx = document.getElementById('grafico4');
    const config = {
        type: 'polarArea',
        data: {
            labels: hobbys,
            datasets: [{
                label: 'Promedios de tiempos (Horas)',
                data: tiempos_promedios,
                backgroundColor: colores
            }]
        },
        options: {}
    };
    const grafico4 = new Chart(ctx, config);
}


//DOCUMENT.READY - EJECUTA LAS FUNCIONES UNA VEZ CARGADO EL CONTENIDO HTML DE LA PÁGINA WEB (DOM).
$(function() {

    $.ajax({
		url: "/api-web/reporte/graficos",
        type: "POST",
		dataType: "json"

	}).done(function(response) {
		console.log(response);

        //SE LLAMA A LAS FUNCIONES PARA GENERAR LOS 4 GRÁFICOS CORRESPONDIENTES A CADA PREGUNTA DE LA ENCUESTA.
        generarGrafico1(response.data1);
        generarGrafico2(response.data2);
        generarGrafico3(response.data3);
        generarGrafico4(response.data4);

	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus, errorThrown);
	});

    //INICIALMENTE SE DEFINE EL TÍTULO DEL INFORME Y EL NOMBRE DEL ARCHIVO A EXPORTAR.
    const titulo = "Resultados de la Encuesta";
    const archivo = "resultados_encuesta";
    
	//SE DEFINE Y CONFIGURA EL DATATABLE.
    $('#tabla_resumen').DataTable({
        "processing": false,
        "deferRender": true,
        "responsive": true,
        "ordering": false,
        "ajax": {
            url: "/api-web/reporte/tabla",
            type: "POST",
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        },
        "columns": [
            {
                data: "id",
                searchable: true,
                orderable: true,
                className: "text-right"
            },
            {
                data: "nombre",
                searchable: true,
                orderable: true,
                className: "text-center"
            },
            {
                data: "genero",
                searchable: true,
                orderable: true,
                className: "text-center"
            },
            {
                data: "hobby",
                searchable: true,
                orderable: true,
                className: "text-center"
            },
            {
                data: "tiempo",
                searchable: true,
                orderable: true,
                className: "text-center"
            },
            {
                data: "fecha",
                searchable: true,
                orderable: true,
                className: "text-center"
            }
        ],
        "buttons": [
            {
                extend: "copy",
                text: "Copiar todo",
                className: "btn btn-primary",
                title: titulo
            },
            {
                extend: "print",
                text: "Imprimir",
                className: "btn btn-primary",
                title: titulo
            },
            {
                extend: "excel",
                text: "Exportar Excel",
                className: "btn btn-primary",
                filename: archivo,
                sheetName: "Informe",
                createEmptyCells: true,
                title: titulo
            },
            {
                extend: "pdf",
                text: "Exportar PDF",
                className: "btn btn-primary",
                filename: archivo,
                orientation: "portrait",
                pageSize: "LETTER",
                title: titulo
            }
        ],
        "dom": `
            <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>
            <'row'<'col-sm-12 mt-3'B>>
        `,
        "language": {
            url: "resource/libraries/DataTables/spanish.json"
        }
    });


    //FUNCIÓN PARA CAMBIAR ENTRE LOS GRÁFICOS A MOSTRAR.
    $(".nav-link").click(function() {
        
        $(".nav-link").removeClass("active");
        $(this).addClass("active");

        const name = $(this).attr("data-name");
        $(".graphy").addClass("d-none");
        $("#"+name).removeClass("d-none");
    });
});


//WINDOW.ONLOAD - EJECUTA LAS FUNCIONES UNA VEZ CARGADO TODO EL CONTENIDO HTML Y LOS RECURSOS GRAFICOS.
window.onload = function() {
    $("#spinner").addClass("d-none");  //Oculta el spinner de carga.
};