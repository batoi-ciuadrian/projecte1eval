<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociatRepositori
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\repository;
use cursophp7\core\database\QueryBuilder;
use cursophp7\app\entity\Associat;

class AssociatRepository extends QueryBuilder {
    public function __construct(string $table = 'asociados', string $classEntity = Associat::class) {
        parent::__construct($table, $classEntity);
    }
    
    /**
     * 
     * @param Associat $associat
     */
    public function guarda(Associat $associat) {
        $fnGuardaAssociat = function () use ($associat) {
            $this->save($associat);
        };
        $this->executeTransaction($fnGuardaAssociat);
    }
    
    public function elimina(Associat $associat) {
        $fnEliminaAssociat = function () use ($associat) {
            $this->delete($associat);
        };
        $this->executeTransaction($fnEliminaAssociat);
    }
    
    public function modifica(Associat $associat) {
        $fnModificaAssociat = function () use ($associat) {
            $this->update($associat);
        };
        $this->executeTransaction($fnModificaAssociat);
    }
}
