<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\repository;
use cursophp7\app\entity\Usuario;
use cursophp7\core\database\QueryBuilder;
/**
 * Description of UsuarioRepository
 *
 * @author Adrian Ciucurenco
 */
class UsuarioRepository extends QueryBuilder {
    public function __construct(string $table = 'usuarios', string $classEntity = Usuario::class) {
        parent::__construct($table, $classEntity);
    }
    
    public function guarda(Usuario $usuario) {
        $fnGuardaUsuario = function () use ($usuario) {
            $this->save($usuario);
        };
        $this->executeTransaction($fnGuardaUsuario);
    }
}
