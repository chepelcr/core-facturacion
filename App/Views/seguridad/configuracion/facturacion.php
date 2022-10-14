<form id="frm_configuracion_empresa">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa-solid fa-circle-user"></i> Informacion de autenticacion
                    </h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Telefono -->
                        <div class="col-md-8 autenticacion">
                            <div class="form-group">
                                <label>
                                    Usuario
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                                    </div>
                                    <input class="form-control inp perfil biller_username" name="biller_username"
                                        type="text" required value="<?= getEnt("factura.userToken")?>"
                                        placeholder="Usuario de facturación">
                                </div>
                            </div>
                        </div>

                        <!-- Correo electronico -->
                        <div class="col-md-4 autenticacion">
                            <div class="form-group">
                                <label>
                                    Contraseña
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-user-secret"></i></span>
                                    </div>
                                    <input class="form-control inp biller_password" name="biller_password"
                                        type="password" required max="100" value="<?= getEnt("factura.userPass")?>"
                                        placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <!-- Informacion de notificaciones -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa-solid fa-circle-exclamation"></i> Notificar documentos
                    </h4>

                    <div class="card-tools">
                        <button type=" button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Notificaciones de emision -->
                        <div class="col-md-12">
                            <div class="row">
                                <!-- Aprobados -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Aprobados
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-check"></i></span>
                                            </div>
                                            <!--- Checkbox -->
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="biller_notify_aproved_documents"
                                                    name="biller_notify_aproved_documents"
                                                    <?php if(isset($biller_notify_aproved_documents) && ($biller_notify_aproved_documents == 1 || $biller_notify_aproved_documents == 3)) echo 'checked'?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rechazados -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Rechazados
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-times"></i></span>
                                            </div>
                                            <!--- Checkbox -->
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="biller_notify_rejected_documents"
                                                    name="biller_notify_rejected_documents"
                                                    <?php if(isset($biller_notify_rejected_documents) && ($biller_notify_rejected_documents == 1 || $biller_notify_rejected_documents == 3)) echo 'checked'?>>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ninguno -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Ningun documento
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-circle"></i></span>
                                                </div>
                                                <!--- Checkbox -->
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox"
                                                        id="biller_notify_none_documents"
                                                        name="biller_notify_none_documents"
                                                        <?php if(isset($biller_notify_none_documents) && ($biller_notify_none_documents == 1 || $biller_notify_none_documents == 3)) echo 'checked'?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
</form>