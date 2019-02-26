<!-- Principal Content Start -->
<div id="contact">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>CONTACT US</h1>
            <hr>
            <br>
            <?php if (!empty($mensajeConfirmacion) || !empty($errores)) : ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php if (empty($errores)) : ?>
                        <p><?= $mensajeConfirmacion ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach ($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <p>Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            <form class="form-horizontal" action="/contact/nuevo" method="POST">
                <div class="form-group">
                    <div class="col-xs-6">
                        <label class="label-control">First Name</label>
                        <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>">
                    </div>
                    <div class="col-xs-6">
                        <label class="label-control">Last Name</label>
                        <input class="form-control" type="text" name="apellidos" value="<?= $apellidos ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Email</label>
                        <input class="form-control" type="text" name="email" value="<?= $email ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Subject</label>
                        <input class="form-control" type="text" name="asunto" value="<?= $asunto ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Message</label>
                        <textarea class="form-control" name="mensaje"><?= $mensaje ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">SEND</button>
                    </div>
                </div>
            </form>
            <?php if ($app['user'] !=  null && $app['user']->getRole() === 'ROLE_ADMIN') : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mensaje</th>
                            <th scope="col">Me gusta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($mensajes ?? []) as $mens) : ?>
                            <tr>
                                <th scope="row"><?= $mens->getId() ?></th>
                                <td><?= $mens->getNombre() ?></td>
                                <td><?= $mens->getApellidos() ?></td>
                                <td><?= $mens->getAsunto() ?></td>
                                <td><?= $mens->getEmail() ?></td>
                                <td><?= $mens->getMensaje() ?></td>
                                <td><?= $mens->getMegusta() ?></td>
                                <td><a href="/contact/<?= $mens->getId() ?>/elimina"><button class="pull-right btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                <td>
                                    <a href="/contact/<?= $mens->getId() ?>/cambiarMG"><button class="pull-right btn btn-info">
                                            <?php if ($mens->getMeGusta() === 'No'): ?>
                                                <i class="fa fa-thumbs-up"></i>
                                            <?php else: ?>
                                            <i class="fa fa-thumbs-down"></i>
                                            <?php endif; ?>
                                        </button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <hr class="divider">
            <div class="address">
                <h3>GET IN TOUCH</h3>
                <hr>
                <p>Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero.</p>
                <div class="ending text-center">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-facebook sr-icons"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter sr-icons"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-google-plus sr-icons"></i></a>
                        </li>
                    </ul>
                    <ul class="list-inline contact">
                        <li class="footer-number"><i class="fa fa-phone sr-icons"></i>  (00228)92229954 </li>
                        <li><i class="fa fa-envelope sr-icons"></i>  kouvenceslas93@gmail.com</li>
                    </ul>
                    <p>Photography Fanatic Template &copy; 2017</p>
                </div>
            </div>   
        </div>
    </div>
</div>
<!-- Principal Content Start -->
</html>