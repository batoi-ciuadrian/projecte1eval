<!-- Principal Content Start -->
<?php use cursophp7\core\helpers\FlashMessage; 
    FlashMessage::set('associatModifyImagen', $associat->getLogo());
    FlashMessage::set('associatModifyId', $associat->getId());

?>
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>MODIFICAR ASSOCIAT</h1>
            <hr>
            <img src="/<?= $associat->getRutaImages()?>"
                alt="<?= $associat->getDescripcion()?>"
                title="<?= $associat->getDescripcion()?>">
            <form class="form-horizontal" action="modify" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Nombre</label><br>
                        <input type="text" name="nombre" value="<?= $associat->getNombre() ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Imagen</label>
                        <input class="form-control-file" type="file" name="imagen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $associat->getDescripcion() ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>