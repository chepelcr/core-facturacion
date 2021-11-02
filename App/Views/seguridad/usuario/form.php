<div class="row">
    <input class="form-control form-control-lg inp" id="id_usuario" name="id_usuario" hidden type="text">

    <!-- Numero de identificacion -->
    <div class="col-md-4">
        <div class="form-group">
            <label class="text-left">Numero de identificacion</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input onblur="verificar()" class="form-control form-control-lg inp" id="cedula_usuario"
                    name="cedula_usuario" type="text"  max="100">
            </div>
        </div>
    </div>

    <!-- Nombre de usuario -->
    <div class="col-md-8">
        <div class="form-group">
            <label class="text-left">Nombre</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                </div>
                <input class="form-control form-control-lg inp" id="nombre_usuario" name="nombre_usuario" type="text"
                    >
            </div>
        </div>
    </div>

    <!-- Rol -->
    <div class="col-md-4">
        <div class="form-group">
            <label class="text-left">Rol</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                </div>
                <select class="form-control inp" name="id_rol"  id="id_rol">
                    <option value="">Seleccione el rol</option>

                    <option value="1">Administrador</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Correo electronico -->
    <div class="col-md-5">
        <div class="form-group">
            <label class="text-left">Correo electronico</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input class="form-control form-control inp" onblur="verificar_correo()" id="correo" name="correo" type="email">
            </div>
        </div>
    </div>

    <!-- Telefono -->
    <div class="col-md-3">
        <div class="form-group">
            <label class="text-left">Telefono</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input class="form-control form-control inp" id="telefono_usuario" name="telefono_usuario" type="text"
                    >
            </div>
        </div>
    </div>
</div>