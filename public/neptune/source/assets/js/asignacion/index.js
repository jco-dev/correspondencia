$(document).ready(function () {

    "use strict";

    let listadoAsignacion = $('#listado-asignacion').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'listado-asignacion-ajax',
            type: 'GET'
        },
        language: {
            url: '/neptune/source/assets/plugins/datatables/lang/es.json'
        }
    }).on('click', 'button.btn-editar', (event) => {
        let id = $(event.target).data('id');
        $.ajax({
            url: 'editar-asignacion',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Asignación Oficina", "modal-lg", false, 'static');

                    $('#frm-editar-asignacion').on('submit',
                        function (e) {
                            e.preventDefault();
                            let datos = $(this).serialize();
                            $.ajax({
                                url: 'actualizar-asignacion',
                                type: 'POST',
                                data: datos,
                                success: function (data) {
                                    if (data.exito) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-asignacion').trigger('reset');
                                        listadoAsignacion.ajax.reload(null, false);
                                        Swal.fire({
                                            title: "EXITO",
                                            text: data.msg,
                                            icon: "success",
                                            showConfirmButton: true,
                                            confirmButtonText: "Aceptar"
                                        });
                                    }

                                    if (data.validacion) {
                                        $('#frm-editar-asignacion input, #frm-editar-asignacion select').removeClass('is-invalid');

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
                                        $('#frm-editar-asignacion').trigger('reset');
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
            }
        });
    }).on('click', 'button.btn-finalizar', (event) => {
        let id = $(event.target).data('id');

        Swal.fire({
            title: "¿Está seguro de finalizar la asignación?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, finalizar",
            cancelButtonText: "No, cancelar",
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: 'finalizar-asignacion',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            listadoAsignacion.ajax.reload(null, false);
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


    });

    $('.btn-agregar-asignacion').on('click', function () {
        $.post('crear-asignacion', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                // $('#id_persona').select2({
                //     placeholder: 'Seleccione una persona',
                //     allowClear: true,
                //     tabIndex: 100,
                // });
                parametrosModal("#modal", "Agregar Asignación de Cargo en una Oficina", "modal-lg", false, 'static');

                $('#frm-registro-asignacion').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-asignacion',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-asignacion').trigger('reset');
                                listadoAsignacion.ajax.reload(null, false);
                                Swal.fire({
                                    title: "EXITO",
                                    text: data.msg,
                                    icon: "success",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }

                            if (data.validacion) {
                                $('#frm-registro-asignacion input, #frm-registro-asignacion select').removeClass('is-invalid');

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
                                $('#frm-registro-asignacion').trigger('reset');
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
    });

});