<form class="row g-3" id="frm-editar-oficina">
    <div class="col-md-12">
        <input type="hidden" name="id_oficina" value="<?= $oficina->id_oficina ?>">
        <label for="nombre" class="form-label ">Nombre de la Oficina <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $oficina->nombre ?>" required/>
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion"><?= $oficina->descripcion ?></textarea>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>
