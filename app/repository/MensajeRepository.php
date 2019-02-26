<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\repository;
use cursophp7\core\database\QueryBuilder;
use cursophp7\app\entity\Mensaje;
/**
 * Description of MensajeRepository
 *
 * @author Adrian Ciucurenco
 */
class MensajeRepository extends QueryBuilder {
    public function __construct(string $table = 'mensajes', string $classEntity = Mensaje::class) {
        parent::__construct($table, $classEntity);
    }
    
    public function guarda(Mensaje $mensaje) {
        $fnGuardaMensaje = function () use ($mensaje) {
            $this->save($mensaje);
        };
        $this->executeTransaction($fnGuardaMensaje);
    }
}
