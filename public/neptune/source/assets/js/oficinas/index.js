$(document).ready(function () {

    "use strict";

    let listadoOficinas = $('#listado-oficinas').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'listado-oficinas-ajax',
            type: 'GET'
        },
        language: {
            url: '/neptune/source/assets/plugins/datatables/lang/es.json'
        }
    }).on('click', 'button.btn-editar', (event) => {
        let id = $(event.target).data('id');
        $.ajax({
            url: 'editar-oficina',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Oficina", "modal-lg", false, 'static');

                    $('#frm-editar-oficina').on('submit',
                        function (e) {
                            e.preventDefault();
                            let datos = $(this).serialize();
                            $.ajax({
                                url: 'actualizar-oficina',
                                type: 'POST',
                                data: datos,
                                success: function (data) {
                                    if (data.exito) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-oficina').trigger('reset');
                                        listadoOficinas.ajax.reload(null, false);
                                        Swal.fire({
                                            title: "EXITO",
                                            text: data.msg,
                                            icon: "success",
                                            showConfirmButton: true,
                                            confirmButtonText: "Aceptar"
                                        });
                                    }

                                    if (data.validacion) {
                                        $('#frm-editar-oficina input, #frm-editar-oficina select').removeClass('is-invalid');

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
                                        $('#frm-editar-oficina').trigger('reset');
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

    $('.btn-agregar-oficina').on('click', function () {
        $.post('crear-oficina', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Oficina", "modal-lg", false, 'static');

                $('#frm-registro-oficina').on('submit', function (e) {
                    e.preventDefault();
                    let datos = $(this).serialize();
                    $.ajax({
                        url: 'registro-oficina',
                        type: 'POST',
                        data: datos,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-oficina').trigger('reset');
                                listadoOficinas.ajax.reload(null, false);
                                Swal.fire({
                                    title: "EXITO",
                                    text: data.msg,
                                    icon: "success",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }

                            if (data.validacion) {
                                $('#frm-registro-oficina input, #frm-registro-oficina select').removeClass('is-invalid');

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
                                $('#frm-registro-oficina').trigger('reset');
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