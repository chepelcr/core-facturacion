<div class="card">
    <div class="card-header">
        <h3 class="card-title">Perfil de usuario</h3>
    </div>


    <div class="card-body">
        <div class="row">
            <!-- Id Field -->
            <input type="text" hidden value="<?php if(isset($perfil->id_usuario)) echo $perfil->id_usuario;?>">

            <!-- Identificacion -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="cedula_usuario">Identificación</label>
                    <input type="text" class="form-control" id="cedula_usuario" name="cedula_usuario"
                        value="<?php if(isset($perfil->identificacion)) echo $perfil->identificacion; ?>" readonly>
                </div>
            </div>

            <!-- Nombre -->
            <div class="col-md-7">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        value="<?php if(isset($perfil->nombre)) echo $perfil->nombre; ?>" readonly>
                </div>
            </div>

            <!-- Correo -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="text" class="form-control" id="correo" name="correo"
                        value="<?php if(isset($perfil->correo)) echo $perfil->correo; ?>" readonly>
                </div>
            </div>

            <!-- Telefono -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono"
                        value="<?php if(isset($perfil->telefono)) echo $perfil->telefono; ?>" readonly>
                </div>
            </div>

            <!-- Rol -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <input type="text" class="form-control" id="rol" name="rol"
                        value="<?php if(isset($perfil->nombre_rol)) echo $perfil->nombre_rol; ?>" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer right">
        <a href="<?php baseUrl('/seguridad/perfil/editar'); ?>" class="btn btn-primary">Editar</a>
        <button class="btn btn-danger" id="btn_contraseña" data-toggle="modal" data-target="#modalAccion">Cambiar contraseña</button>
    </div>
</div>

<?php
    echo view('base/form', $dataForm);
?>