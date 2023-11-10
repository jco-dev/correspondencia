<form class="row g-3" id="frm-registro-documento" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="tipo_documento" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
        <select class="form-select" name="tipo_documento" id="tipo_documento" required>
            <option value="">-- Seleccione --</option>
            <option value="DOCUMENTO INTERNO">DOCUMENTO INTERNO</option>
            <option value="DOCUMENTO EXTERNO">DOCUMENTO EXTERNO</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tipo_informe" class="form-label ">Tipo Documento <span class="text-danger">(*)</span></label>
        <select class="form-select" name="tipo_informe" id="tipo_informe" required>
            <option value="">-- Seleccione --</option>
            <option value="INFORME">INFORME</option>
            <option value="MEMÓRANDUM">MEMÓRANDUM</option>
            <option value="NOTA INTERNA">NOTA INTERNA</option>
        </select>
    </div>

    <div class="col-12">
        <label for="numero_correlativo" class="form-label">Número Correlativo <span class="text-danger">(*)</span></label>
        <input class="form-control" name="numero_correlativo" id="numero_correlativo" value="<?= $numero_correlativo ?>" readonly />
    </div>

    <div class="col-12">
        <label for="referencia" class="form-label">Referencia <span class="text-danger">(*)</span></label>
        <textarea class="form-control" name="referencia" id="referencia" rows="3"></textarea>
    </div>

    <div class="col-12">
        <label for="archivo" class="form-label">Archivo</label>
        <input class="form-control" type="file" name="archivo" id="archivo" />
    </div>

    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
