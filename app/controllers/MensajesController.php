<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\controllers;

use cursophp7\app\entity\Mensaje;
use cursophp7\app\repository\MensajeRepository;
use cursophp7\core\App;
use cursophp7\app\utils\MyMail;
use cursophp7\core\Response;
use cursophp7\app\exceptions\ValidationException;
use cursophp7\core\helpers\FlashMessage;
use Dompdf\Dompdf;

/**
 * Description of MensajesController
 *
 * @author Adrian Ciucurenco
 */
class MensajesController {

    public function contact() {
        $mensajes = App::getRepository(MensajeRepository::class)->findAll();
        $errores = FlashMessage::get('erroresContact', []);
        $mensajeConfirmacion = FlashMessage::get('mensajeContact');
        $nombre = FlashMessage::get('nombreContact');
        $apellidos = FlashMessage::get('apellidosContact');
        $email = FlashMessage::get('emailContact');
        $asunto = FlashMessage::get('asuntoContact');
        $mensaje = FlashMessage::get('messageContact');
        Response::renderView('contact', 'layout', compact('errores', 'mensajeConfirmacion', 'nombre', 'apellidos', 'email', 'asunto', 'mensaje', 'mensajes'));
    }

    public function nuevo() {
        $errores = [];
        try {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $apellidos = trim(htmlspecialchars($_POST['apellidos']));
            $email = trim(htmlspecialchars($_POST['email']));
            $asunto = trim(htmlspecialchars($_POST['asunto']));
            $mensaje = trim(htmlspecialchars($_POST['mensaje']));

            if (empty($nombre)) {
                array_push($errores, 'El campo nombre no puede estar vacio');
            }

            if (!empty($email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    array_push($errores, 'El campo email no tiene un formato correcto');
                }
            } else {
                array_push($errores, 'El campo email no puede estar vacio');
            }

            if (empty($asunto)) {
                array_push($errores, 'El campo asunto no puede estar vacio');
            }

            FlashMessage::set('nombreContact', $nombre);
            FlashMessage::set('apellidosContact', $apellidos);
            FlashMessage::set('emailContact', $email);
            FlashMessage::set('asuntoContact', $asunto);
            FlashMessage::set('messageContact', $mensaje);

            if (count($errores) !== 0) {
                throw new ValidationException('Faltan algunoc campos por rellenar');
            }

            FlashMessage::set('mensajeContact', 'Se ha guardado el mensaje correctamente');

            $mens = new Mensaje($nombre, $apellidos, $email, $asunto, $mensaje);
            $mensajeRepository = new MensajeRepository();
            $mensajeRepository->guarda($mens);

            $myMail = new MyMail();
            $myMail->send($asunto, $email, $nombre, $mensaje);
            $myMail->send('Nuevo mensaje de '.$nombre, 'chickmusices@gmail.com', 'Adrian',
                    'Hola, has recibido un nuevo mensaje en la web de ' . $nombre . '. Este es el mensaje que ha dejado: "' . $mensaje . '"');

            App::get('router')->redirect('contact');
        } catch (ValidationException $ex) {
            FlashMessage::set('erroresContact', $errores);
            App::get('router')->redirect('contact');
        }
    }
    
    public function cambiarMG(int $id) {
        $imgRepository = App::getRepository(MensajeRepository::class);
        $mensaje = $imgRepository->find($id);
        if($mensaje->getMeGusta() === 'No') {
            $mensaje->setMeGusta('Si');
        } else {
            $mensaje->setMeGusta('No');
        }
        
        $imgRepository->update($mensaje);
        
        App::get('router')->redirect('contact');
    }
    
    public function delete(int $id) {
        $msgRepository = App::getRepository(MensajeRepository::class);
        $mensaje = $msgRepository->find($id);
        $msgRepository->delete($mensaje);
        App::get('router')->redirect('contact');
    }

}
