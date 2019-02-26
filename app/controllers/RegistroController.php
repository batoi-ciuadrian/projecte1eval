<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\controllers;
use cursophp7\app\exceptions\ValidationException;
use cursophp7\core\helpers\FlashMessage;
use cursophp7\core\Response;
use cursophp7\core\App;
use cursophp7\app\repository\UsuarioRepository;
use cursophp7\app\entity\Usuario;
/**
 * Description of RegistroController
 *
 * @author Adrian Ciucurenco
 */
class RegistroController {
    
    public function vista() {
        $errores = FlashMessage::get('registro-error', []);
        $username = FlashMessage::get('registro-user');
        Response::renderView('register', 'layout', compact('errores', 'username'));
    }

    public function registro() {
        try {
            $errores = FlashMessage::get('registro-error', []);
            if (!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }

            if (!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }

            FlashMessage::set('registro-user', $_POST['username']);

            if (!isset($_POST['password']) || empty($_POST['password'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }
            
            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username']
            ]);
            
            if(!is_null($usuario)) {
                throw new ValidationException('El usuario ya existe');
            }
            
            $newUser = new Usuario($_POST['username'], $_POST['password']);
            $registroRepository = App::getRepository(UsuarioRepository::class);
            $registroRepository->guarda($newUser);
            
            FlashMessage::noset('registro-user');
            
            App::get('router')->redirect('');
        } catch (ValidationException $ex) {
            FlashMessage::set('registro-error', [$ex->getMessage()]);
            App::get('router')->redirect('registro');
        }
    }

}
