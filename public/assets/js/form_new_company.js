$(document).ready(function () {

    "use strict";

    var empty = false;
    $('form input').each(function() {
        if ($(this).val() == '') {
            empty = true;
        }
    });

    if (empty)
        $('button[type="submit"]').attr('disabled', 'disabled');
    else
        $('button[type="submit"]').removeAttr('disabled');

    $('form input').on('keyup', function() {
        var empty = false;
        $('form input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty)
            $('button[type="submit"]').attr('disabled', 'disabled');
        else
            $('button[type="submit"]').removeAttr('disabled');
    });

    // Mapbox
    if(ciudad_user_geo_lon != undefined && ciudad_user_geo_lon != null && ciudad_user_geo_lon != ''){
        mapboxgl.accessToken = accessToken;
        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: 'metric',
            profile: 'mapbox/driving'
        });
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        });
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [ciudad_user_geo_lon, ciudad_user_geo_lat], // longitud, latitud
            zoom: 5
        });
    }

    $('#pills-ubicacion-tab').on('shown.bs.tab', function (e) {
        if (e.target.id === 'pills-ubicacion-tab') {
            if(ciudad_user_geo_lon != undefined && ciudad_user_geo_lon != null && ciudad_user_geo_lon != ''){
                if (map && typeof map.resize === 'function') {
                    map.resize();
                    geocoder.query(direccion_empresa, function(err, data) {
                        if (err) {
                            console.error(err);
                            return;
                        }

                        var longitud = data.features[0].geometry.coordinates[0];
                        var latitud = data.features[0].geometry.coordinates[1];

                        new mapboxgl.Marker()
                        .setLngLat([longitud, latitud])
                        .addTo(map);
                    });
                }
            }
        }
    });

    if(ciudad_user_geo_lon != undefined && ciudad_user_geo_lon != null && ciudad_user_geo_lon != ''){
        map.addControl(geocoder);

        geocoder.on('result', function(e) {
            var lon = e.result.geometry.coordinates[0];
            var lat = e.result.geometry.coordinates[1];
            var position = [lon, lat];
            console.log(position);
            var address = e.result.place_name;
            var html_direccion = document.getElementById('direccion');
            var prov_actual = document.getElementById('prov_actual');
            if(html_direccion != undefined && html_direccion != null){
                if(address != undefined && address != null && address != ''){
                    html_direccion.innerHTML = '';
                    html_direccion.innerHTML = address;
                    if(address.includes(prov_actual.innerHTML)){
                        $('#prov_actual').css('color', 'green');
                        if(html_direccion.innerHTML != ''){
                            $('#btn_guardar_ubicacion').css('display', 'block');
                            $('#btn_guardar_ubicacion').on('click', function() {
                                $.ajax({
                                    url: route_guarda_ubic, // Reemplaza esto con la URL de tu servidor
                                    type: 'POST',
                                    data: {
                                        ubicacion: html_direccion.innerHTML
                                    },
                                    success: function(response) {
                                        if(response.status == 'ok'){
                                            $('#result_ok').css('display', 'block');
                                            setTimeout(function() {
                                                $('#result_ok').alert('close');
                                            }, 5000);
                                        }else{
                                            $('#result_error').css('display', 'block');
                                            setTimeout(function() {
                                                $('#result_error').alert('close');
                                            }, 5000);
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        $('#result_error').css('display', 'block');
                                        setTimeout(function() {
                                            $('#result_error').alert('close');
                                        }, 5000);
                                    }
                                });
                            });
                        }
                    }else{
                        $('#prov_actual').css('color', 'red');
                    }
                }
            }

            directions.setOrigin(position);
        });
    }

});
