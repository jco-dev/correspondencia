<?= $this->extend('base') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="section-description section-description-inline px-0">
            <h1>Dashboard</h1>
            <span>Página de Inicio</span>
        </div>
        <div class="card">
            <div class="card-body">
                Bienvenidos al Sistema de Correspondencia
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>

<?php $this->section('js') ?>
<script>
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: '<?= session()->getFlashdata("success") ?>',
        timer: 3000,
        confirmButton: false
    });
    <?php endif; ?>
</script>
<?php $this->endSection() ?>

