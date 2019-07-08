function cambiaDefecto(valor) {
    console.log(valor);
    document.miFormulario.busqueda.value = valor + ' ';
    ponerFocus();
}

function ponerFocus() {
    window.document.getElementById("busqueda").focus();
}


function limpiarRebase() {
    window.document.form1.piezas.value = '';
    window.document.form1.tarea.value = '';
    window.document.form1.importe.value = 0.00;
    window.document.getElementById("piezas").focus();
}
function CalculoTiempoExtraDobles(sueldo) {
    var horas = window.document.form2.horasDobles.value;
    var resultado = ((sueldo / 67.2) * 2) * horas;
    window.document.form2.importeDobles.value = resultado.toFixed(2);
}
function CalculoTiempoExtraTriples(sueldo) {
    var horas = window.document.form2.horasTriples.value;
    var resultado = ((sueldo / 67.2) * 3) * horas;
    window.document.form2.importeTriples.value = resultado.toFixed(2);
}
function LimpiarTiempoExtra() {
    window.document.form2.horasDobles.value = '';
    window.document.form2.horasTriples.value = '';
    window.document.form2.importeDobles.value = '';
    window.document.form2.importeTriples.value = '';
    window.document.getElementById("horasDobles").focus();
}

function ampliar() {
    var contenedor = document.getElementById("contenedorCanva");
    var valorC = contenedor.clientHeight;
    console.log(valorC);
    if (valorC == 300) {
        contenedor.style.height = "0px";

    } else {
        contenedor.style.height = "300px";
    }
}
function mostrar(lun, mar, mier, jue, vie, sab, dom) {
    //bar chart
    var ctx = document.getElementById("barChart");
    //    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"],
            datasets: [
                {
                    label: "Tiempo Extra",
                    data: [lun, mar, mier, jue, vie, sab, dom],
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
}

document.addEventListener('keyup', event => {
    if (event.ctrlKey && event.keyCode === 66) {
        ponerFocus();
        document.miFormulario.busqueda.value = '';
    }
}, false)


