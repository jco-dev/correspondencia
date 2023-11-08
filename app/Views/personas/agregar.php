<form class="row g-3" id="frm-registro-persona">
    <div class="col-md-6">
        <label for="ci" class="form-label ">CI <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="ci" name="ci" placeholder="C.I." required/>
    </div>
    <div class="col-md-6">
        <label for="expedido" class="form-label">Expedido <span class="text-danger">(*)</span></label>
        <select class="form-select" id="expedido" name="expedido" required>
            <option value="">-- seleccione --</option>
            <option value="LP">LP</option>
            <option value="CB">CB</option>
            <option value="SC">SC</option>
            <option value="OR">OR</option>
            <option value="PT">PT</option>
            <option value="TJ">TJ</option>
            <option value="CH">CH</option>
            <option value="BN">BN</option>
            <option value="PD">PD</option>
            <option value="QR">QR</option>
        </select>
    </div>

    <div class="col-4">
        <label for="nombre" class="form-label">Nombres <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombres..." required>
    </div>
    <div class="col-4">
        <label for="paterno" class="form-label">Paterno</label>
        <input type="text" class="form-control" id="paterno" name="paterno" placeholder="paterno" />
    </div>
    <div class="col-4">
        <label for="materno" class="form-label">Paterno</label>
        <input type="text" class="form-control" id="materno" name="materno" placeholder="paterno" />
    </div>

    <div class="col-6">
        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento <span class="text-danger">(*)</span></label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
    </div>
    <div class="col-6">
        <label for="celular" class="form-label">Celular <span class="text-danger">(*)</span></label>
        <input type="number" class="form-control" id="celular" name="celular" required />
    </div>

    <div class="col-12">
        <label for="correo_electronico" class="form-label">Correo Electrónico <span class="text-danger">(*)</span></label>
        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required />
    </div>
    <div class="col-12">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control" name="direccion" id="direccion"></textarea>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
