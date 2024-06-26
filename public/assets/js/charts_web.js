$(document).ready(function () {

    "use strict";

    //  Chart ( 1 )
    var element = document.getElementById('myChart'); // Asegúrate de reemplazar 'myChart' con el id del elemento que tiene el atributo 'data-datos'
    if(element != null){
        var data = element.getAttribute('data-datos');
        var array_data = data.split(",");
        let singleValue = JSON.parse(array_data[0]); // Tu valor único
        let position = 2; // La posición donde quieres el valor único
        let length = 12; // La longitud del nuevo array
        // Crea un nuevo array con ceros
        let newArray = Array(length).fill(0);
        newArray[position] = singleValue[0];
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Núm. Usuarios',
                    data: newArray,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
        });
    }

});
