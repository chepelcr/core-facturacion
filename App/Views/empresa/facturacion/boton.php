<!-- Factura <?=$numero_documento?> -->
<div class="col-md-4 col-lg col-md col-sm p-1 col-btn-fct-<?=$numero_documento?>">
    <button class="btn btn-dark btn-factura nav-button w-100" type="button" onclick="ver_factura('<?=$numero_documento?>')" id="btn_factura_<?=$numero_documento?>"
        value="<?=$numero_documento?>">
        Documento <?=$numero_documento?>
    </button>
</div>