<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaRepository
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\repository;
use cursophp7\core\database\QueryBuilder;
use cursophp7\app\entity\Categoria;

class CategoriaRepository extends QueryBuilder {
    public function __construct(string $table = 'categorias', string $classEntity = Categoria::class) {
        parent::__construct($table, $classEntity);
    }
    
    /**
     * 
     * @param Categoria $categoria
     */
    public function nuevaImagen(Categoria $categoria) {
        $categoria->setNumImagenes($categoria->getNumImagenes() + 1);
        
        $this->update($categoria);
    }
}
