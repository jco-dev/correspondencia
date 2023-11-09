<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('/neptune/source/assets/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Cargos</h1>
            <span>Listado de personas a oficinas</span>
            <div class="page-description-actions text-end">
                <button class="btn btn-primary btn-agregar-asignacion">
                    <i class="material-icons">add</i>
                    Registrar asignación
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="listado-asignacion" class="display" style="width: 100%; font-size:12px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Persona</th>
                            <th>Oficina</th>
                            <th>Cargo</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">-->
<!--    <div class="modal-dialog" id="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="modal-title">Modal title</h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div class="modal-body" id="modal-body"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/js/asignacion/index.js') ?>"></script>
<?= $this->endSection() ?>
