<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>ASSOCIATS</h1>
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
            <form class="form-horizontal" action="/associats/nou" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Nombre</label><br>
                        <input type="text" name="nombre" required>
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
                        <textarea class="form-control" name="descripcion"></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <div class="imagenes_galeria">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <?php if($app['user']->getRole() === 'ROLE_ADMIN') : ?>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Modificar</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($asociados ?? []) as $asociado) : ?>
                            <tr>
                                <th scope="row"><?= $asociado->getId()?></th>
                                <td>
                                    <img src="<?= $asociado->getRutaImages()?>"
                                         alt="<?= $asociado->getDescripcion()?>"
                                         title="<?= $asociado->getDescripcion()?>"
                                </td>
                                <td><?= $asociado->getNombre() ?></td>
                                <td><?= $asociado->getDescripcion()?></td>
                                <?php if($app['user']->getRole() === 'ROLE_ADMIN') : ?>
                                <td><a href="/associats/<?= $asociado->getId() ?>/delete"><button class="pull-right btn btn-danger">ELIMINAR <span><i class="fa fa-trash"></i></span></button></a></td>
                                <td><a href="/associats/<?= $asociado->getId() ?>/show-modify"><button class="pull-right btn btn-warning">MODIFICAR <span><i class="fa fa-edit"></i></span></button></a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if($app['user']->getRole() === 'ROLE_ADMIN') : ?>
                <a href="/associats/imprimir"><button class="pull-right btn btn-info">IMPRIMIR <span><i class="fa fa-print"></i></span></button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->

