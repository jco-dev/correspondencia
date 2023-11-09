<form class="row g-3" id="frm-editar-asignacion">
    <div class="col-md-12">
        <label for="id_persona" class="form-label ">Persona <span class="text-danger">(*)</span></label>
        <input type="hidden" name="id_asignacion_oficina" value="<?= $asignacion_oficina->id_asignacion_oficina ?>">
        <select name="id_persona" id="id_persona" class="js-states form-control" style="width: 100%;" required>
            <option value="">-- seleccione una persona --</option>
            <?php foreach ($personas as $persona) : ?>
                <option <?= ($persona->id_persona == $asignacion_oficina->id_persona) ? 'selected' : ''; ?>
                        value="<?= $persona->id_persona ?>"><?= $persona->ci . ' ' . $persona->expedido . ' - ' . $persona->nombre . ' ' . $persona->paterno . ' ' . $persona->materno ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12">
        <label for="id_oficina" class="form-label">Oficina <span class="text-danger">(*)</span></label>
        <select name="id_oficina" id="id_oficina" class="js-states form-control" data-bs-parent="#modal"
                style="width: 100%;" required>
            <option value="">-- seleccione una oficina --</option>
            <?php foreach ($oficinas as $oficina) : ?>
                <option <?= ($oficina->id_oficina == $asignacion_oficina->id_oficina) ? 'selected' : ''; ?>
                        value="<?= $oficina->id_oficina ?>"><?= $oficina->nombre ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-6">
        <label for="grado_academico" class="form-label">Grado Académico Persona <span
                    class="text-danger">(*)</span></label>
        <select name="grado_academico" id="grado_academico" class="form-control" required>
            <option value="">-- seleccione --</option>
            <option <?= ($asignacion_oficina->grado_academico) == 'P.Ph.D.' ? 'selected' : ''; ?> value="P.Ph.D.">
                P.Ph.D.
            </option>
            <option <?= ($asignacion_oficina->grado_academico) == 'Ph.D.' ? 'selected' : ''; ?> value="Ph.D.">Ph.D.
            </option>
            <option <?= ($asignacion_oficina->grado_academico) == 'M.Sc.' ? 'selected' : ''; ?> value="M.Sc.">M.Sc.
            </option>
            <option <?= ($asignacion_oficina->grado_academico) == 'Esp.' ? 'selected' : ''; ?> value="Esp.">Esp.
            </option>
            <option <?= ($asignacion_oficina->grado_academico) == 'Lic.' ? 'selected' : ''; ?> value="Lic.">Lic.
            </option>
        </select>
    </div>

    <div class="col-6">
        <label for="cargo" class="form-label">Grado Académico Persona <span class="text-danger">(*)</span></label>
        <select name="cargo" id="cargo" class="form-control" required>
            <option value="">-- seleccione --</option>
            <option <?= ($asignacion_oficina->cargo) == 'JEFE' ? 'selected' : ''; ?> value="JEFE">JEFE</option>
            <option <?= ($asignacion_oficina->cargo) == 'SECRETARIA' ? 'selected' : ''; ?> value="SECRETARIA">
                SECRETARIA
            </option>
        </select>
    </div>

    <div class="col-6">
        <label for="fecha_inicio" class="form-label">Fecha inicio <span class="text-danger">(*)</span></label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"  value="<?= $asignacion_oficina->fecha_inicio ?>" required/>
    </div>

    <div class="col-6">
        <label for="fecha_fin" class="form-label">Fecha fin <span class="text-danger">(*)</span></label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"  value="<?= $asignacion_oficina->fecha_fin ?>" required/>
    </div>

    <div class="col-12">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>
