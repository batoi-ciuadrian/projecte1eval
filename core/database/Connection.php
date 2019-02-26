<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\core\database;
use cursophp7\core\App;
use \PDO;
use \PDOException;
use cursophp7\app\exceptions\AppException;
class Connection {
    /**
     * 
     * @return \PDO
     * @throws AppException
     */
    public static function make() {
        try {
            $config = App::get('config')['database'];
            
            $connection = new PDO(
                    $config['connection'].';dbname='.$config['name'],
                    $config['username'], $config['password'], $config['options']);
        } catch (PDOException $PDOException) {
            throw new AppException('No se ha podido crear la conexión a la base de datos');
        }
        
        return $connection;
    }
}
