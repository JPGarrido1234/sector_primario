$(document).ready(function () {

    "use strict";


    mapboxgl.accessToken = accessToken

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-3.7037902, 40.4167754], // longitud, latitud
        zoom: 10
    });

    $('#select-provincia').change(function() {
        select_provincia_dato = $(this).val();
        url_todos = url_base + select_provincia_dato;
    });

    $('#btn-todo').on('click', function() {
        console.log(url_todos);
        $.ajax({
            url: url_todos, // URL a la que se realiza la solicitud
            type: "GET", // Tipo de solicitud
            success: function(response) {
                if(response){
                    var data = response;
                    var posiciones = [
                        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [-3.7037902, 40.4167754] } },
                    ];
                    console.log("Datos recibidos:", response);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error);
            }
        });

        map.on('load', () => {
            map.loadImage(
                icon_tienda_url,
                (error, image) => {
                    if (error) throw error;

                    map.addImage('tienda', image);
                    map.addSource('point', {
                        'type': 'geojson',
                        'data': {
                            'type': 'FeatureCollection',
                            'features': posiciones
                        }
                    });

                    map.addLayer({
                        'id': 'points',
                        'type': 'symbol',
                        'source': 'point', // reference the data source
                        'layout': {
                            'icon-image': 'tienda', // reference the image
                            'icon-size': 0.5
                        }
                    });
                }
            );
        });
    });
    /*

    var posiciones = [
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [-3.7037902, 40.4167754] } },
        // Agrega más posiciones aquí
    ];

    map.on('load', function () {
        // Agrega la fuente de datos
        map.addSource('posiciones', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': posiciones
            }
        });

        // Agrega la capa con la imagen
        map.loadImage(icon_tienda_url , function (error, image) {
            if (error) throw error;
            map.addImage('imagen', image);
            map.addLayer({
                'id': 'posiciones',
                'type': 'symbol',
                'source': 'posiciones',
                'layout': {
                    'icon-image': 'imagen',
                    'icon-size': 0.05 // Cambia el tamaño de la imagen aquí
                }
            });
        });
    });
    */
});
