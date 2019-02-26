<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenGaleriaRepository
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\repository;
use cursophp7\core\database\QueryBuilder;
use cursophp7\app\entity\ImagenGaleria;
use cursophp7\app\repository\CategoriaRepository;
use cursophp7\app\entity\Categoria;

class ImagenGaleriaRepository extends QueryBuilder {
    public function __construct(string $table = 'imagenes', string $classEntity = ImagenGaleria::class) {
        parent::__construct($table, $classEntity);
    }
    
    /**
     * 
     * @param ImagenGaleria $imagenGaleria
     * @return \Categoria
     */
    public function getCategoria(ImagenGaleria $imagenGaleria) :Categoria {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }
    
    /**
     * 
     * @param ImagenGaleria $imagenGaleria
     */
    public function guarda(ImagenGaleria $imagenGaleria) {
        $fnGuardaImagen = function () use ($imagenGaleria) {
            $categoria = $this->getCategoria($imagenGaleria);
            $categoriaRepository = new CategoriaRepository();
            $categoriaRepository->nuevaImagen($categoria);
            $this->save($imagenGaleria);
        };
        $this->executeTransaction($fnGuardaImagen);
    }
}
