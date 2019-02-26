<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\entity;
use cursophp7\core\database\IEntity;

class Categoria implements IEntity {
    
    private $id;
    
    private $nombre;
    
    private $numImagenes;
    
    public function __construct(string $nombre = '', int $numImagenes = 0) {
        $this->id = null;
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }
    
    public function getId() :int{
        return $this->id;
    }

    public function getNombre() :string{
        return $this->nombre;
    }

    public function getNumImagenes() :int{
        return $this->numImagenes;
    }

    public function setNombre($nombre) :Categoria{
        $this->nombre = $nombre;
        return $this;
    }

    public function setNumImagenes($numImagenes) :Categoria{
        $this->numImagenes = $numImagenes;
        return $this;
    }
    
    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes()
        ];
    }

}
