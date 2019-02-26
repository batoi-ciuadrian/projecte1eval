<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of associat
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\entity;
use cursophp7\core\database\IEntity;

class Associat implements IEntity{
    const RUTA_IMAGES = 'images/index/associats/';
    
    private $id;
    private $nombre;
    private $logo;
    private $descripcion;
    
    public function __construct($nom = '', $logo = '', $descripcio = '') {
        $this->id = null;
        $this->nombre = $nom;
        $this->logo = $logo;
        $this->descripcion = $descripcio;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function getRutaImages() {
        return self::RUTA_IMAGES.$this->getLogo();
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'logo' => $this->getLogo(),
            'descripcion' => $this->getDescripcion()
        ];
    }

}
