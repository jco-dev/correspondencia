<?= $this->extend('base') ?>

<?= $this->section('css') ?>
<link href="<?= base_url('/neptune/source/assets/plugins/datatables/datatables.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Enviados</h1>
            <span>Listado de envios(Hojas de rutas)</span>
            <div class="page-description-actions text-end">
                <button class="btn btn-primary btn-agregar-envio">
                    <i class="material-icons">add</i>
                    Registrar nueva hoja de ruta
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="listado-enviados" class="display" style="width: 100%; font-size:13px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Oficina</th>
                            <th>Estado</th>
                            <th>Nº HR</th>
                            <th>Remitente</th>
                            <th>Correlativo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
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
<script src="<?= base_url('/neptune/source/assets/js/envio_hoja_ruta/index.js') ?>"></script>
<?= $this->endSection() ?>
