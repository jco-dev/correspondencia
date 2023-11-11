$(document).ready(function () {

    "use strict";

    let listadoPendientes = $('#listado-pendientes').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'listado-pendientes-ajax',
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
    }).on('click', 'button.btn-archivar', (event) => {
        let id = $(event.target).data('id');
        Swal.fire({
            title: "¿Está seguro de archivar el Documento?",
            text: "ESTA ACCIÓN NO SE PUEDE REVERTIR",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                // mostrar input
                Swal.fire({
                    title: "Ingrese el motivo del archivo del documento",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    reverseButtons: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "¡Debe ingresar el motivo del archivo!";
                        }

                        $.ajax({
                            url: 'archivar-pendiente',
                            type: 'POST',
                            data: {
                                id: id,
                                motivo_archivado: value
                            },
                            success: function (data) {
                                if (data.exito) {
                                    listadoPendientes.ajax.reload(null, false);
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


            }
        });
    });
});