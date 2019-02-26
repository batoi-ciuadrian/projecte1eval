<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\controllers;
use cursophp7\app\repository\ImagenGaleriaRepository;
use cursophp7\app\repository\CategoriaRepository;
use cursophp7\core\App;
use cursophp7\app\utils\File;
use cursophp7\app\entity\ImagenGaleria;
use cursophp7\core\Response;
use cursophp7\app\exceptions\FileException;
use cursophp7\app\exceptions\ValidationException;
use cursophp7\core\helpers\FlashMessage;
use cursophp7\app\exceptions\AuthenticationException;

/**
 * Description of ImagenGaleriaController
 *
 * @author Adrian Ciucurenco
 */
class ImagenGaleriaController {

    public function galeria() {
        $imagenes = App::getRepository(ImagenGaleriaRepository::class)->findAll();
        $categorias = App::getRepository(CategoriaRepository::class)->findAll();
        
        $errores = FlashMessage::get('errores', []);
        $mensajeConfirmacion = FlashMessage::get('mensaje');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');

        Response::renderView('galeria', 'layout', compact('imagenes', 'categorias', 'descripcion', 'errores', 'mensajeConfirmacion', 'categoriaSeleccionada'));
    }
    
    public function nueva() {
        try{
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);
            $categoria = trim(htmlspecialchars($_POST['categoria']));

            if (empty($categoria)) {
                throw new ValidationException('No se ha recibido la categoria');
            }
            FlashMessage::set('categoriaSeleccionada', $categoria);

            $tiposAceptados = ['image/jpeg', 'image/png', 'image/gif'];
            $imagen = new File('imagen', $tiposAceptados);

            $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
            $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);

            $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
            $imgRepository = App::getRepository(ImagenGaleriaRepository::class);
            $imgRepository->guarda($imagenGaleria);

            $message = "Se ha guardado una nueva imagen: ".$imagenGaleria->getNombre();
            App::get('logger')->add($message);
            
            FlashMessage::set('mensaje', $message);
            FlashMessage::noset('descripcion');
            FlashMessage::noset('categoriaSeleccionada');
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (ValidationException $validationException) {
            FlashMessage::set('errores', [$validationException->getMessage()]);
        }
        
        App::get('router')->redirect('imagenes-galeria');
    }
    
    public function show(int $id) {
        $imagen = App::getRepository(ImagenGaleriaRepository::class)->find($id);
        Response::renderView(
                'show-imagen-galeria', 'layout',
                compact('imagen'));
    }
}
