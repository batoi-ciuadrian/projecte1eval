<?php
    $router->get('', 'PagesController@index');
    $router->get('about', 'PagesController@about');
    $router->get('associats', 'AssociatsController@associats', 'ROLE_USER');
    $router->get('associats/:id/delete', 'AssociatsController@delete', 'ROLE_ADMIN');
    $router->get('associats/:id/show-modify', 'AssociatsController@showModify', 'ROLE_ADMIN');
    $router->post('associats/:id/modify', 'AssociatsController@modify', 'ROLE_ADMIN');
    $router->get('blog', 'PagesController@blog');
    $router->get('contact', 'MensajesController@contact');
    $router->get('imagenes-galeria', 'ImagenGaleriaController@galeria', 'ROLE_USER');
    $router->get('imagenes-galeria/:id', 'ImagenGaleriaController@show', 'ROLE_USER');
    $router->get('post', 'PagesController@post');
    $router->post('imagenes-galeria/nueva', 'ImagenGaleriaController@nueva', 'ROLE_ADMIN');
    $router->post('associats/nou', 'AssociatsController@nou', 'ROLE_ADMIN');
    $router->post('contact/nuevo', 'MensajesController@nuevo');
    $router->get('login', 'AuthController@login');
    $router->post('check-login', 'AuthController@checkLogin');
    $router->get('logout', 'AuthController@logout', 'ROLE_USER');
    $router->get('registro', 'RegistroController@vista');
    $router->post('registro/nuevo', 'RegistroController@registro');
    $router->get('contact/:id/cambiarMG', 'MensajesController@cambiarMG');
    $router->get('contact/:id/elimina', 'MensajesController@delete');
    $router->get('associats/imprimir', 'AssociatsController@imprimir');
