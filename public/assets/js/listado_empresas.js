$(document).ready(function () {

    "use strict";

    $('#empresas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: empresasUrl,
        language: {
            url: "/js/Spanish.json"
        },
        columns: [
            { data: 'tipo', name: 'tipo' },
            { data: 'nombre', name: 'nombre' },
            { data: 'cif', name: 'cif' },
            { data: 'url_imagen', name: 'url_imagen',
                render: function(data, type, row) {
                    if(data == 'default'){
                        return 'default';
                    }else{
                        return '<img src="/storage/' + data + '" style="width:50px;height:50px;"/>';
                    }
                }
             },
            { data: 'telefono', name: 'telefono' },
            { data: 'sector', name: 'sector' },
            { data: 'web', name: 'web' },
            { data: 'circulo', name: 'circulo' },
            { data: 'condiciones', name: 'condiciones' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    var day = date.getDate();
                    var year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                }
            },
            { data: 'acciones', name: 'acciones', orderable: false, searchable: false}
        ]
    });
});
