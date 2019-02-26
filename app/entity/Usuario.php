<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\entity;
use cursophp7\core\database\IEntity;

/**
 * Description of Usuario
 *
 * @author Adrian Ciucurenco
 */
class Usuario implements IEntity {
    
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     *
     * @var string
     */
    private $username;
    
    /**
     *
     * @var string
     */
    private $password;
    
    /**
     *
     * @var string
     */
    private $role;
    
    public function __construct($username = '', $password = '', $role = 'ROLE_USER') {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setId($id): Usuario {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username): Usuario {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password): Usuario {
        $this->password = $password;
        return $this;
    }

    public function setRole($role): Usuario {
        $this->role = $role;
        return $this;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole()
        ];
    }

}
