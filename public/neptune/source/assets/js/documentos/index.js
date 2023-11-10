$(document).ready(function () {

    "use strict";

    let listadoDocumentos = $('#listado-documentos').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate
            }
        },
        select: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'listado-documentos-ajax',
            type: 'GET'
        },
        language: {
            url: '/neptune/source/assets/plugins/datatables/lang/es.json'
        }
    }).on('click', 'button.btn-editar', (event) => {
        let id = $(event.currentTarget).data('id');
        $.ajax({
            url: 'editar-documento',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                if (data.vista) {
                    $('#modal .modal-body').html(data.vista);
                    parametrosModal("#modal", "Editar Documento", "modal-lg", false, 'static');

                    $('#frm-editar-documento').on('submit',
                        function (e) {
                            e.preventDefault();
                            let formData = new FormData(this);
                            $.ajax({
                                url: 'actualizar-documento',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    if (data.exito) {
                                        $('#modal').modal('hide');
                                        $('#frm-editar-documento').trigger('reset');
                                        listadoDocumentos.ajax.reload(null, false);
                                        Swal.fire({
                                            title: "EXITO",
                                            text: data.msg,
                                            icon: "success",
                                            showConfirmButton: true,
                                            confirmButtonText: "Aceptar"
                                        });
                                    }

                                    if (data.validacion) {
                                        $('#frm-editar-documento input, #frm-editar-documento select').removeClass('is-invalid');

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
                                        $('#frm-editar-documento').trigger('reset');
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
    }).on('click', 'button.btn-descargar', (e) =>{
        let id = $(e.currentTarget).data('id');
        window.open(`descargar-documento/${id}`, '_blank');
    }).on('click', 'button.eliminar-archivo', (e) =>{
        let id = $(e.currentTarget).data('id');
        Swal.fire({
            title: "¿Estás seguro el archivo?",
            text: "¡NO SE PUEDE REVERTIR!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, borrar!",
            cancelButtonText: "¡No, cancelar!",
            reverseButtons: true
        }).then(function (result) {
            if(result.value){
                $.ajax({
                    url: 'eliminar-archivo',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data.exito) {
                            $('#modal').modal('hide');
                            $('#frm-editar-documento').trigger('reset');
                            listadoDocumentos.ajax.reload(null, false);
                            Swal.fire({
                                title: "EXITO",
                                text: data.msg,
                                icon: "success",
                                showConfirmButton: true,
                                confirmButtonText: "Aceptar"
                            });
                        }

                        if (data.exito == false) {
                            $('#modal').modal('hide');
                            $('#frm-editar-documento').trigger('reset');
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
        })
    })

    $('.btn-agregar-documento').on('click', function () {
        $.post('crear-documento', function (data) {
            if (data.vista) {
                $('#modal .modal-body').html(data.vista);
                parametrosModal("#modal", "Agregar Documento", "modal-lg", false, 'static');

                $('#frm-registro-documento').on('submit', function (e) {
                    e.preventDefault();
                    let formData = new FormData(this);
                    $.ajax({
                        url: 'registro-documento',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data.exito) {
                                $('#modal').modal('hide');
                                $('#frm-registro-documento').trigger('reset');
                                listadoDocumentos.ajax.reload(null, false);
                                Swal.fire({
                                    title: "EXITO",
                                    text: data.msg,
                                    icon: "success",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar"
                                });
                            }

                            if (data.validacion) {
                                $('#frm-registro-documento input, #frm-registro-documento select').removeClass('is-invalid');

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
                                $('#frm-registro-documento').trigger('reset');
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