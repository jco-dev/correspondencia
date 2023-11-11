<form class="row g-3" id="frm-registro-envio">
    <div class="col-12">
        <h4 class="text-center text-center"><strong>DATOS DEL REMITENTE</strong></h4>
        <hr>
    </div>

    <div class="col-6">
        <label for="oficina_remitente" class="form-label ">Oficina remitente</label>
        <input type="text" class="form-control" id="oficina_remitente" name="oficina_remitente" value="<?= $oficina_remitente?>" disabled/>
    </div>

    <div class="col-6">
        <label for="remitente" class="form-label ">Remitente</label>
        <input type="text" class="form-control" id="remitente" name="remitente" value="<?= $jefe_oficina ?>" disabled/>
    </div>

    <div class="col-8">
        <label for="id_documento" class="form-label">Adjuntar Nota o Informe <span class="text-danger">(*)</span></label>
       <select class="form-select" id="id_documento" name="id_documento" required />
        <option value="">-- seleccione un documento --</option>
        <?php foreach ($documentos as $documento) : ?>
            <option value="<?= $documento->id_documento ?>"><?= $documento->numero_correlativo . '/' . date("Y", strtotime($documento->creado_el)) . ' - ' . $documento->referencia  ?></option>
        <?php endforeach; ?>
        </select>
    </div>

    <div class="col-4">
        <label for="numero_hojas" class="form-label ">Nro hojas <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="numero_hojas" name="numero_hojas"  required />
    </div>

    <div class="col-12 mt-3">
        <label for="referencia" class="form-label ">Referencia <span class="text-danger">(*)</span></label>
        <textarea class="form-control" name="referencia" id="referencia" disabled></textarea>
    </div>


    <div class="col-12">
        <h4 class="text-center text-center"><strong>DATOS DESTINATARIO</strong></h4>
        <hr>
    </div>

    <div class="col-8">
        <label for="id_oficina_destino" class="form-label">Oficina Destino <span class="text-danger">(*)</span></label>
        <select class="form-select" id="id_oficina_destino" name="id_oficina_destino" required />
            <option value="">-- seleccione destino --</option>
            <?php foreach ($oficinas as $oficina) : ?>
                <option value="<?= $oficina->id_oficina ?>"><?= $oficina->nombre ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-4">
        <label for="prioridad" class="form-label">Prioridad <span class="text-danger">(*)</span></label>
        <select class="form-select" id="prioridad" name="prioridad" required />
            <option>-- seleccione --</option>
            <option value="NORMAL">NORMAL</option>
            <option value="URGENTE">URGENTE</option>
        </select>
    </div>

    <div class="col-12 mt-5">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
