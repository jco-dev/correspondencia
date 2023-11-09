<form class="row g-3" id="frm-registro-oficina">
    <div class="col-md-12">
        <label for="nombre" class="form-label ">Nombre de la Oficina <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="nombre" name="nombre" required/>
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
