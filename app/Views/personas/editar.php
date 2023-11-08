<form class="row g-3" id="frm-editar-persona">
    <div class="col-md-6">
        <input type="hidden" name="id_persona" value="<?= $persona->id_persona?>">
        <label for="ci" class="form-label ">CI <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="ci" name="ci" placeholder="C.I." value="<?= $persona->ci ?>" readonly required/>
    </div>
    <div class="col-md-6">
        <label for="expedido" class="form-label">Expedido <span class="text-danger">(*)</span></label>
        <select class="form-select" id="expedido" name="expedido" required>
            <option value="">-- seleccione --</option>
            <option <?= ($persona->expedido)== 'LP'? 'selected' : ''; ?> value="LP">LP</option>
            <option <?= ($persona->expedido)== 'CB'? 'selected' : ''; ?> value="CB">CB</option>
            <option <?= ($persona->expedido)== 'SC'? 'selected' : ''; ?> value="SC">SC</option>
            <option <?= ($persona->expedido)== 'OR'? 'selected' : ''; ?> value="OR">OR</option>
            <option <?= ($persona->expedido)== 'PT'? 'selected' : ''; ?> value="PT">PT</option>
            <option <?= ($persona->expedido)== 'TJ'? 'selected' : ''; ?> value="TJ">TJ</option>
            <option <?= ($persona->expedido)== 'CH'? 'selected' : ''; ?> value="CH">CH</option>
            <option <?= ($persona->expedido)== 'BN'? 'selected' : ''; ?> value="BN">BN</option>
            <option <?= ($persona->expedido)== 'PD'? 'selected' : ''; ?> value="PD">PD</option>
            <option <?= ($persona->expedido)== 'QR'? 'selected' : ''; ?> value="QR">QR</option>
        </select>
    </div>

    <div class="col-4">
        <label for="nombre" class="form-label">Nombres <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombres..." value="<?= $persona->nombre ?>" required>
    </div>
    <div class="col-4">
        <label for="paterno" class="form-label">Paterno</label>
        <input type="text" class="form-control" id="paterno" name="paterno" placeholder="paterno" value="<?= $persona->paterno ?>" />
    </div>
    <div class="col-4">
        <label for="materno" class="form-label">Paterno</label>
        <input type="text" class="form-control" id="materno" name="materno" placeholder="paterno" value="<?= $persona->materno ?>" />
    </div>

    <div class="col-6">
        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento <span class="text-danger">(*)</span></label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $persona->fecha_nacimiento ?>" required>
    </div>
    <div class="col-6">
        <label for="celular" class="form-label">Celular <span class="text-danger">(*)</span></label>
        <input type="number" class="form-control" id="celular" name="celular" value="<?= $persona->celular ?>" required />
    </div>

    <div class="col-12">
        <label for="correo_electronico" class="form-label">Correo Electrónico <span class="text-danger">(*)</span></label>
        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= $persona->correo_electronico ?>" required />
    </div>
    <div class="col-12">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea class="form-control" name="direccion" id="direccion"><?= $persona->direccion ?></textarea>
    </div>
    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Editar Persona</button>
    </div>
</form>