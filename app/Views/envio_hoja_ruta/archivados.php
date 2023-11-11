<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Archivados</h1>
            <span>Listado de archivados</span>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="listado-archivados" class="display" style="width: 100%; font-size:13px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Oficina</th>
                            <th>Oficina</th>
                            <th>Nº HR</th>
                            <th>Destinatario</th>
                            <th>Correlativo</th>
                            <th>Registro</th>
                            <th>Estado</th>
                            <th>Archivado por</th>
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
<script src="<?= base_url('/neptune/source/assets/js/envio_hoja_ruta/archivados.js') ?>"></script>
<?= $this->endSection() ?>
