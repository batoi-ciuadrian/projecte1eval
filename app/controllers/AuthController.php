<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\controllers;
use cursophp7\core\Response;
use cursophp7\core\helpers\FlashMessage;
use cursophp7\app\exceptions\ValidationException;
use cursophp7\core\App;
use cursophp7\app\repository\UsuarioRepository;
/**
 * Description of AuthController
 *
 * @author Adrian Ciucurenco
 */
class AuthController {
    public function login() {
        $errores = FlashMessage::get('login-error', []);
        $username = FlashMessage::get('username');
        Response::renderView('login', 'layout', compact('errores', 'username'));
    }
    
    public function checkLogin() {
        try {
            if(!isset($_POST['username']) || empty($_POST['username'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }
           
            FlashMessage::set('username', $_POST['username']);
            
            if(!isset($_POST['password']) || empty($_POST['password'])) {
                throw new ValidationException('Debes introducir el usuario y el password');
            }
            
            $usuario = App::getRepository(UsuarioRepository::class)->findOneBy([
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ]);

            if(!is_null($usuario)) {
                $_SESSION['loguedUser'] = $usuario->getId();

                FlashMessage::noset('username');
                
                App::get('router')->redirect('');
            }

            throw new ValidationException('El usuario y/o el password introducido no existen');
        } catch (ValidationException $ex) {
            FlashMessage::set('login-error', [$ex->getMessage()]);
            App::get('router')->redirect('login');
        }
        
    }
    
    public function logout() {
        if(isset($_SESSION['loguedUser'])) {
            $_SESSION['loguedUser'] = null;
            unset($_SESSION['loguedUser']);
        }
        
        App::get('router')->redirect('login');
    }
}
