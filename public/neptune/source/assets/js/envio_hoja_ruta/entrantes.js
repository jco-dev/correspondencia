$(document).ready(function () {

    "use strict";

    let listadoEntrantes = $('#listado-entrantes').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'listado-entrantes-ajax',
            type: 'GET'
        },
        language: {
            url: '/neptune/source/assets/plugins/datatables/lang/es.json'
        },
        columnDefs: [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [1],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [2],
                "visible": false,
                "searchable": false
            }
        ]
    }).on('click', 'button.btn-recibir', (event) => {
        let id = $(event.target).data('id');
        Swal.fire({
            title: "¿Está seguro de de recepcionar el envío?",
            text: "ESTA ACCIÓN NO SE PUEDE REVERTIR",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'recibir-entrante',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            listadoEntrantes.ajax.reload(null, false);
                            Swal.fire({
                                title: "EXITO",
                                text: data.msg,
                                icon: "success",
                                showConfirmButton: true,
                                confirmButtonText: "Aceptar"
                            });
                        }

                        if (data.exito == false) {
                            Swal.fire({
                                title: "¡ERROR!",
                                text: data.msg,
                                icon: "error",
                                showConfirmButton: true,
                            });
                        }
                    }
                });
            }
        });
    }).on('click', 'button.btn-descargar', (event) => {
        let id = $(event.currentTarget).data('id');
        window.open(`descargar-envio/${id}`, '_blank');
    });
});