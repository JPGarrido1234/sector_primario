$(document).ready(function () {

    "use strict";

    $('#box_form_card').hide();
    $('#nuevoProducto').prop('disabled', true);

    $('#frutas, #verduras').change(function() {
        $('#loading-icon').show();
        $('#box_form_card').hide();
        if (this.id == 'frutas' && this.checked) {
            $('#verduras').prop('checked', false);
        } else if (this.id == 'verduras' && this.checked) {
            $('#frutas').prop('checked', false);
        }

        var frutas = $('#frutas').is(':checked') ? 1 : 0;
        var verduras = $('#verduras').is(':checked') ? 1 : 0;

        $.ajax({
            url: url_get_productos,
            method: 'POST',
            data: {
                frutas: frutas,
                verduras: verduras,
                _token: token
            },
            success: function(response) {
                if (response.res) {
                    if(frutas == 0 && verduras == 0){
                        $('#lista_productos').html('');
                        $('#loading-icon').hide();
                        $('#box_form_card').hide();
                        return;
                    }else{
                        var card = '';
                        response.res.forEach(element => {
                            card += '<div id="'+element.id+'" class="col-3 box">' +
                            '<div class="card d-flex align-items-center" style="border: 1px solid #4bad48;" onclick="handleCardClick(\'' + element.id + '\', \'' + element.descripcion + '\')">' +
                               '<img style="width:216px; height:130px; margin-top:15px;" src="../assets/frutasVerduras/' + element.image_url + '" class="card-img-top" alt="...">' +
                               '<div class="card-body">' +
                                   element.name +
                               '</div>' +
                           '</div>' +
                           '</div>';
                        });

                      $('#lista_productos').html(card);

                      $('#loading-icon').hide();
                    }
                }
            }
        });
    });

    $('input.form-control:not([type="checkbox"])').on('input', function() {
        var todosTienenValor = true;
        $('input.form-control:not([type="checkbox"])').each(function() {
            if (!$(this).val()) {
                todosTienenValor = false;
            }
        });

        if (todosTienenValor) {
            $('#nuevoProducto').prop('disabled', false);
        } else {
            $('#nuevoProducto').prop('disabled', true);
        }
    });


    for (var i = 0; i < productos_js.length; i++) {
        var idProducto = productos_js[i].id;
        var elemento = document.getElementById('distancia_' + idProducto);
        var valor = elemento.textContent || elemento.innerText; // Obtiene el texto del elemento
        var miUbicacion_lonlat = miUbicacion.split(' ');
        var miLon = miUbicacion_lonlat[0];
        var miLat = miUbicacion_lonlat[1];
        var partes = valor.split(' ');
        var longitud = partes[0];
        var latitud = partes[1];
        var from = turf.point([miLon, miLat]);
        var to = turf.point([longitud, latitud]);

        var options = {units: 'kilometers'};
        var distancia = turf.distance(from, to, options);
        elemento.innerHTML = '';
        elemento.innerHTML = '<b>Distancia</b> :'+ distancia.toFixed(2) + ' km';
    }

});
