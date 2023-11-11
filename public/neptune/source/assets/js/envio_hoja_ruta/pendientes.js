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
    })
    .on('click', 'button.btn-remitir', (event) => {
        let id = $(event.target).data('id');
        $.get('remitir-pendiente', {id: id}, (data) => {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Remitir documento", "modal-lg", false, 'static');

                $('#id_documento').on('change', function () {
                    let id_documento = $(this).val();
                    $.ajax({
                        url: 'cargar-referencia',
                        type: 'POST',
                        data: {
                            id_documento: id_documento
                        },
                        success: function (data) {
                            $('#referencia').val(data.referencia);
                        }
                    });
                });

                $('#frm-registro-remitir').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-envio-remitir',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-remitir').trigger('reset');
                                listadoPendientes.ajax.reload(null, false);
                                Swal.fire({
                                    title: "EXITO",
                                    text: data.msg,
                                    icon: "success",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }

                            if (data.validacion) {
                                $('#frm-registro-remitir input, #frm-registro-remitir select').removeClass('is-invalid');

                                let errorList = '<ul>';
                                for (let [key, value] of Object.entries(data.validacion)) {
                                    $(`#${key}`).addClass('is-invalid');
                                    errorList += `<li>${value}</li>`;
                                }
                                errorList += '</ul>';

                                Swal.fire({
                                    title: "¡ADVERTENCIA!",
                                    html: errorList,
                                    icon: "warning",
                                    showConfirmButton: true,
                                });
                            }

                            if (data.exito == false) {
                                $('#modal').modal('hide');
                                $('#frm-registro-remitir').trigger('reset');
                                Swal.fire({
                                    title: "¡ERROR!",
                                    text: data.msg,
                                    icon: "error",
                                    showConfirmButton: true,
                                });
                            }
                        }
                    });

                });

            }
        });
    })
    .on('click', 'button.btn-descargar', (event) => {
        let id = $(event.currentTarget).data('id');
        window.open(`descargar-envio/${id}`, '_blank');
    });
});