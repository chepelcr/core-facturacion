<div class="row">
    <input class="form-control inp" value="<?php if(isset($id_usuario)) echo $id_usuario; ?>" type='hidden'
        id="id_usuario" name="id_usuario">

    <!-- Identificacion -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="cedula_usuario">Identificación</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-id-card"></i>
                    </span>
                </div>
                <input type="text" class="form-control inp perfil" onblur="verificar()" id="cedula_usuario" name="cedula_usuario" required
                    placeholder="Identificación" value="<?php if(isset($cedula_usuario)) echo $cedula_usuario; ?>">
            </div>
        </div>
    </div>

    <!-- Nombre completo -->
    <div class="col-md-8">
        <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control inp perfil" id="nombre" name="nombre" placeholder="Nombre Completo"
                    required value="<?php if(isset($nombre)) echo $nombre; ?>">
            </div>
        </div>
    </div>

    <!-- Nombre usuario -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="nombre_usuario">Nombre de usuario</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control inp perfil" id="nombre_usuario" name="nombre_usuario" required
                    placeholder="Nombre de usuario" value="<?php if(isset($nombre_usuario)) echo $nombre_usuario; ?>">
            </div>
        </div>
    </div>

    <!-- Correo -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="correo">Correo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control inp perfil" id="correo" name="correo" placeholder="Correo" required
                    value="<?php if(isset($correo)) echo $correo; ?>">
            </div>
        </div>
    </div>

    <!-- Telefono -->
    <div class="col-md-3">
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-phone"></i>
                    </span>
                </div>
                <input type="text" class="form-control inp perfil" id="telefono" name="telefono" placeholder="Teléfono"
                    required value="<?php if(isset($telefono)) echo $telefono; ?>">
            </div>
        </div>
    </div>
</div>