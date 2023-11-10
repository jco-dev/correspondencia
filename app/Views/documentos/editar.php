<form class="row g-3" id="frm-editar-documento" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="tipo_documento" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
        <input type="hidden" name="id_documento" value="<?= $documento->id_documento ?>">
        <select class="form-select" name="tipo_documento" id="tipo_documento" required>
            <option value="">-- Seleccione --</option>
            <option <?= ($documento->tipo_documento)== 'DOCUMENTO INTERNO'? 'selected' : ''; ?> value="DOCUMENTO INTERNO">DOCUMENTO INTERNO</option>
            <option <?= ($documento->tipo_documento)== 'DOCUMENTO EXTERNO'? 'selected' : ''; ?> value="DOCUMENTO EXTERNO">DOCUMENTO EXTERNO</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tipo_informe" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
        <select class="form-select" name="tipo_informe" id="tipo_informe" required>
            <option value="">-- Seleccione --</option>
            <option <?= ($documento->tipo_informe)== 'INFORME'? 'selected' : ''; ?> value="INFORME">INFORME</option>
            <option <?= ($documento->tipo_informe)== 'MEMÓRANDUM'? 'selected' : ''; ?> value="MEMÓRANDUM">MEMÓRANDUM</option>
            <option <?= ($documento->tipo_informe)== 'NOTA INTERNA'? 'selected' : ''; ?> value="NOTA INTERNA">NOTA INTERNA</option>
        </select>
    </div>

    <div class="col-12">
        <label for="numero_correlativo" class="form-label">Número Correlativo <span class="text-danger">(*)</span></label>
        <input class="form-control" name="numero_correlativo" id="numero_correlativo" value="<?= $documento->numero_correlativo ?>" readonly />
    </div>

    <div class="col-12">
        <label for="referencia" class="form-label">Referencia <span class="text-danger">(*)</span></label>
        <textarea class="form-control" name="referencia" id="referencia" rows="3"><?= $documento->referencia ?></textarea>
    </div>

    <div class="col-12">
        <label for="archivo" class="form-label">Archivo</label>
        <input class="form-control" type="file" name="archivo" id="archivo" />
        <?php if($documento->archivo): ?>
            <span class="badge badge-secondary text-center d-block mt-2"><?= $documento->archivo ?></span></h5>
        <?php endif; ?>
    </div>

    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>
