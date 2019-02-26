<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagesController
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\app\controllers;

use cursophp7\app\repository\ImagenGaleriaRepository;
use cursophp7\app\repository\AssociatRepository;
use cursophp7\app\repository\MensajeRepository;
use cursophp7\core\App;
use cursophp7\app\exceptions\QueryException;
use cursophp7\app\utils\Utils;
use cursophp7\core\Response;

class PagesController {
    
    /**
     * 
     * @throws QueryException
     */
    public function index() {
        $categorias = ['category1' => TRUE, 'category2' => FALSE, 'category3' => FALSE];
        $array = App::getRepository(ImagenGaleriaRepository::class)->findAll();

        $associats = App::getRepository(AssociatRepository::class)->findAll();

        $associatsAleatori = Utils::extraerAleatorio($associats, 3);
        
        Response::renderView('index', 'layout', compact('array', 'associats', 'categorias', 'associatsAleatori'));

    }
    
    public function about() {
        $mensajes = App::getRepository(MensajeRepository::class)->findAll();
        $mensajesConfirmados = [];
        foreach ($mensajes as $mensaje) {
            if($mensaje->getMeGusta() === 'Si') {
                array_push($mensajesConfirmados, $mensaje);
            }
        }
        $mensajesAleatorios = Utils::extraerAleatorio($mensajesConfirmados, 4);
        Response::renderView('about', 'layout-with-footer', compact('mensajesAleatorios'));
    }
    
    public function blog() {
        Response::renderView('blog', 'layout-with-footer');
    }
    
    public function post() {
        Response::renderView('single_post', 'layout-with-footer');
    }
}
