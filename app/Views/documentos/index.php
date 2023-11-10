<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Documentos</h1>
            <span>Listado de documentos registrados</span>
            <div class="page-description-actions text-end">
                <button class="btn btn-primary btn-agregar-documento">
                    <i class="material-icons">add</i>
                    Registrar documento
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="listado-documentos" class="display" style="width: 100%; font-size:11px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo Documento</th>
                            <th>Referencia</th>
                            <th>Archivo</th>
                            <th>Creado por</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('/neptune/source/assets/js/documentos/index.js') ?>"></script>
<?= $this->endSection() ?>
