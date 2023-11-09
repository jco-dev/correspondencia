
<form class="row g-3" id="frm-cambiar-clave">
    <div class="col-md-12">
        <label for="clave_actual" class="form-label ">Contraseña Actual <span class="text-danger">(*)</span></label>
        <input type="password" class="form-control" name="clave_actual" id="clave_actual" required />
    </div>

    <div class="col-md-12">
        <label for="clave_nueva" class="form-label ">Nueva Contraña <span class="text-danger">(*)</span></label>
        <input type="password" class="form-control" name="clave_nueva" id="clave_nueva" required />
    </div>

    <div class="col-md-12">
        <label for="clave_confirmar" class="form-label ">Repita Contraña <span class="text-danger">(*)</span></label>
        <input type="password" class="form-control" name="clave_confirmar" id="clave_confirmar" required />
    </div>

    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
