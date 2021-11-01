<div class="row">
    <input class="form-control form-control-lg inp" id="id_usuario" name="id_usuario" hidden type="text">

    <!-- Numero de identificacion -->
    <div class="input-group mb-3 col-md-6">
        <label class="text-left col-md-4">Numero de identificacion</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
        </div>
        <input onblur="verificar()" class="form-control form-control-lg inp" id="cedula_usuario" name="cedula_usuario"
            type="text" required max="100">
    </div>

    <!-- Nombre de usuario -->
    <div class="input-group mb-3 col-md-6">
        <label class="text-left col-md-4">Nombre de usuario</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        <input class="form-control form-control-lg inp" id="nombre_usuario" name="nombre_usuario" required>
    </div>

    <!-- Nombre del cliente -->
    <div class="input-group mb-3 col-md-6">
        <label class="text-left col-md-4">Nombre</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
        </div>
        <input class="form-control inp" id="nombre" name="nombre" type="text" required max="100">
    </div>

    <!-- Apellidos -->
    <div class="input-group mb-3 col-md-6">
        <label class="text-left col-md-4">Apellidos</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
        </div>
        <input class="form-control inp" id="apellido" name="apellido" type="text" required max="100">
    </div>

    <!-- Rol -->
    <div class="input-group mb-3 col-md-6">
        <label for="codigo_cabys" class="text-left col-md-4">Rol</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
        </div>
        <select class="form-control inp" name="id_rol" required id="id_rol">
            <option value="">Seleccione el rol</option>

            <option value="1">Administrador</option>
        </select>
    </div>

    <!-- Contrasenia -->
    <div class="input-group mb-3 col-md-6">
        <label class="text-left col-md-4">Contraseña</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <input class="form-control inp" id="contrasenia" name="contrasenia" type="password" required max="100">
    </div>

    <!-- Correo electronico -->
    <div class="input-group mb-3 col-md-8">
        <label class="text-left col-md-3">Correo electronico</label>
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        <input class="form-control form-control-lg inp" id="correo" name="correo" type="email" required max="100">
    </div>

    <!-- Activo -->
    <div class="input-group mb-3 col-md-4">
        <label class="text-left col-md-3">Activo</label>
        <input class="form-control inp" id="estado" name="estado" type="checkbox">
    </div>

    <div class="col-md-12">
        <?= view('base/provincias', $dataProvincias) ?>
    </div>
</div>