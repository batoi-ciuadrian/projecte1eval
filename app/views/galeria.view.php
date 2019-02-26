<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>GALERÍA</h1>
            <hr>
            <?php if(!empty($mensajeConfirmacion) || !empty($errores)) : ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php if(empty($errores)) : ?>
                        <p><?= $mensajeConfirmacion ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form class="form-horizontal" action="imagenes-galeria/nueva" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Imagen</label>
                        <input class="form-control-file" type="file" name="imagen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Categoria</label>
                        <select class="form-control-file" name="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                            <option
                                value="<?= $categoria->getId() ?>"
                                <?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>
                            ><?= $categoria->getNombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <hr class="divider">
            <div class="imagenes_galeria">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Visualizaciones</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Descargas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($imagenes ?? []) as $imagen) : ?>
                            <tr>
                                <th scope="row"><?= $imagen->getId()?></th>
                                <td>
                                    <img src="<?= $imagen->getUrlGallery()?>"
                                         alt="<?= $imagen->getDescripcion()?>"
                                         title="<?= $imagen->getDescripcion()?>"
                                </td>
                                <td><?= $imagen->getCategoria() ?></td>
                                <td><?= $imagen->getNumVisualizaciones()?></td>
                                <td><?= $imagen->getNumLikes()?></td>
                                <td><?= $imagen->getNumDownloads()?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->
