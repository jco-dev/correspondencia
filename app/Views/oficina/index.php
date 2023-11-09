<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Oficinas</h1>
            <span>Listado de oficinas</span>
            <div class="page-description-actions text-end">
                <button class="btn btn-primary btn-agregar-oficina">
                    <i class="material-icons">add</i>
                    Registrar oficina
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="listado-oficinas" class="display" style="width: 100%; font-size:13px;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Oficina</th>
                        <th>Descripción</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
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
<script src="<?= base_url('/neptune/source/assets/js/oficinas/index.js') ?>"></script>
<?= $this->endSection() ?>
