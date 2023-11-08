$(document).ready(function () {

    "use strict";

    let listadoPersonas = $('#listado-personas').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        serverSide: true,
        ajax: {
            url: 'listado-personas-ajax',
            type: 'GET'
        },
        language: {
            url: '/neptune/source/assets/plugins/datatables/lang/es.json'
        }
    }).on('click', 'button.btn-editar', (event) => {
        let id = $(event.target).data('id');
        $.ajax({
            url: 'editar-persona',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Persona", "modal-lg", false, 'static');

                    $('#frm-editar-persona').on('submit',
                        function (e) {
                            e.preventDefault();
                            let datos = $(this).serialize();
                            $.ajax({
                                url: 'actualizar-persona',
                                type: 'POST',
                                data: datos,
                                success: function (data) {
                                    if (data.exito) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-persona').trigger('reset');
                                        listadoPersonas.ajax.reload(null, false);
                                        Swal.fire({
                                            title: "EXITO",
                                            text: data.msg,
                                            icon: "success",
                                            showConfirmButton: true,
                                            confirmButtonText: "Aceptar"
                                        });
                                    }

                                    if (data.validacion) {
                                        $('#frm-editar-persona-persona input, #frm-editar-persona select').removeClass('is-invalid');

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
                                        $('#frm-editar-persona').trigger('reset');
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
    });

    $('.btn-agregar-persona').on('click', function () {
        $.post('crear-persona', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Persona", "modal-lg", false, 'static');

                $('#ci').on('change', function () {
                    let ci = $(this).val();
                    $.ajax({
                        url: 'verificar-ci',
                        type: 'POST',
                        data: {
                            ci: ci
                        },
                        success: function (data) {
                            if (data.exito) {
                                $('#ci').val('');
                                $('#ci').focus();
                                $('#frm-registro-persona').trigger('reset');
                                Swal.fire({
                                    title: "ADVERTENCIA",
                                    text: "El usuario ya existe",
                                    icon: "warning",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }
                        }
                    });
                });

                $('#frm-registro-persona').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-persona',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-persona').trigger('reset');
                                listadoPersonas.ajax.reload(null, false);
                                Swal.fire({
                                    title: "EXITO",
                                    text: data.msg,
                                    icon: "success",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }

                            if (data.validacion) {
                                $('#frm-registro-persona input, #frm-registro-persona select').removeClass('is-invalid');

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
                                $('#frm-registro-persona').trigger('reset');
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