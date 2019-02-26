<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\entity;

use cursophp7\core\database\IEntity;

/**
 * Description of Mensaje
 *
 * @author Adrian Ciucurenco
 */
class Mensaje implements IEntity {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $asunto;
    private $mensaje;
    private $fecha;
    private $meGusta;

    public function __construct(string $nombre = '', string $apellidos = '', string $email = '', string $asunto = '', string $mensaje = '') {
        $this->id = null;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
        $this->fecha = date('Y-m-d');
        $this->meGusta = 'No';
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getMeGusta() {
        return $this->meGusta;
    }
    
    public function setMeGusta($meGusta) {
        $this->meGusta = $meGusta;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'email' => $this->getEmail(),
            'asunto' => $this->getAsunto(),
            'mensaje' => $this->getMensaje(),
            'fecha' => $this->getFecha(),
            'meGusta' => $this->getMeGusta()
        ];
    }

}
