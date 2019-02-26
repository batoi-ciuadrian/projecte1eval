<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenGaleria
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\entity;
use cursophp7\core\database\IEntity;

class ImagenGaleria implements IEntity {
    const RUTA_IMAGENES_PORTFOLIO = 'images/index/portfolio/';
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';
    
    private $id;
    /**
     *
     * @var String
     */
    private $nombre;
    /**
     *
     * @var String
     */
    private $descripcion;
    /**
     *
     * @var Int
     */
    private $numVisualizaciones;
    /**
     *
     * @var Int
     */
    private $numLikes;
    /**
     *
     * @var Int
     */
    private $numDownloads;
    
    private $categoria;
    
    public function __construct(String $nombre = '', String $descripcion = '', int $categoria = 1, int $numVisualizaciones = 0, int $numLikes = 0, int $numDownloads = 0) {
        $this->id = null;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
        $this->categoria = $categoria;
    }
    
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return $this->getDescripcion();
    }

    
    public function getNombre(): String {
        return $this->nombre;
    }

    public function getDescripcion(): String {
        return $this->descripcion;
    }

    public function getNumVisualizaciones(): int {
        return $this->numVisualizaciones;
    }

    public function getNumLikes(): int {
        return $this->numLikes;
    }

    public function getNumDownloads(): int {
        return $this->numDownloads;
    }

    public function setNombre(String $nombre): ImagenGaleria {
        $this->nombre = $nombre;
        return $this;
    }

    function setDescripcion(String $descripcion): ImagenGaleria {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setNumVisualizaciones(int $numVisualizaciones): ImagenGaleria {
        $this->numVisualizaciones = $numVisualizaciones;
        return $this;
    }

    public function setNumLikes(int $numLikes): ImagenGaleria {
        $this->numLikes = $numLikes;
        return $this;
    }

    public function setNumDownloads(int $numDownloads): ImagenGaleria {
        $this->numDownloads = $numDownloads;
        return $this;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    public function getUrlPortfolio(): String {
        return self::RUTA_IMAGENES_PORTFOLIO.$this->getNombre();
    }
    
    public function getUrlGallery(): String {
        return self::RUTA_IMAGENES_GALLERY.$this->getNombre();
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDownloads' => $this->getNumDownloads(),
            'categoria' => $this->getCategoria()
        ];
    }

}
