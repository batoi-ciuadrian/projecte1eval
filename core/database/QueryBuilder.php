<?php
/*
require_once __DIR__ . '/../exceptions/QueryException.php';
require_once __DIR__ . '/../core/App.php';*/
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryBuilder
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\core\database;
use cursophp7\core\App;
use cursophp7\app\exceptions\NotFoundException;
use \PDO;

abstract class QueryBuilder {
    /*
     * @var PDO
     */

    private $connection;
    private $table;
    private $classEntity;

    public function __construct(string $table, string $classEntity) {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }
    
    /**
     * 
     * @param string $sql
     * @return array
     * @throws QueryException
     */
    private function executeQuery(string $sql, array $parameters = []) :array {
        $pdoStatement = $this->connection->prepare($sql);

        if ($pdoStatement->execute($parameters) === false) {
            throw new QueryException('No se ha podido ejecutar la query solicitada');
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    /**
     * 
     * @param string $table
     * @param string $classEntity
     * @return array
     * @throws QueryException
     */
    public function findAll(): array {
        $sql = "SELECT * FROM $this->table";

        return $this->executeQuery($sql);
    }

    /**
     * 
     * @param IEntity $entity
     * @throws QueryException
     */
    public function save(IEntity $entity): void {
        try {
            $parameters = $entity->toArray();
            $sql = sprintf(
                    'insert into %s (%s) values (%s)', $this->table, implode(', ', array_keys($parameters)), ':' . implode(', :', array_keys($parameters)));

            $statement = $this->connection->prepare($sql);

            $statement->execute($parameters);
        } catch (PDOException $exception) {
            throw new QueryException('Error al insertar en la base de datos');
        }
    }
     /**
      * 
      * @param int $id
      * @return \IEntity
      * @throws NotFoundException
      */
    public function find(int $id) :IEntity {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        
        $result = $this->executeQuery($sql);
        
        if(empty($result)) {
            throw new NotFoundException("No se ha encontrado ningún elemento con el id $id");
        }
        
        return $result[0];
    }
    
    public function executeTransaction(callable $fnExecutequerys) {
        try {
            $this->connection->beginTransaction();
            
            $fnExecutequerys();
            
            $this->connection->commit();
        } catch (PDOException $pdoException) {
            $this->connection->rollBack();
            throw new QueryException('No se ha podido realizar la operación');
        }
    }
    
    /**
     * 
     * @param type $parameters
     * @return string
     */
    private function getUpdates($parameters) {
        $updates = '';
        
        foreach ($parameters as $key => $value) {
            if($key !== 'id') {
                if($updates !== '') {
                    $updates .= ', ';
                }
                
                $updates .= $key.'=:'.$key;
            }
        }
        
        return $updates;
    }

    public function update(IEntity $entity) :void {
        try {
            $parameters = $entity->toArray();

            $sql = sprintf(
                    'UPDATE %s SET %s WHERE id=:id',
                    $this->table,
                    $this->getUpdates($parameters));

            $statement = $this->connection->prepare($sql);
            
            $statement->execute($parameters);
        } catch (PDOException $pdoException) {
            throw new QueryException('Error al actualizar el elemento con id '.$parameters['id']);
        }
            
    }
    
    public function delete(IEntity $entity) {
        $id = $entity->getId();
        $sql = sprintf("DELETE FROM %s WHERE id=$id", $this->table);
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
    
    public function findBy(array $filters): array {
        $sql = "SELECT * FROM $this->table ".$this->getFilters($filters);
        
        return $this->executeQuery($sql, $filters);
    }
    
    private function getFilters(array $filters) {
        if(empty($filters)) {
            return '';
        }
        
        $strFilters = [];
        
        foreach ($filters as $key=>$value) {
            $strFilters[] = $key.'=:'.$key;
        }
        
        return ' WHERE '.implode(' and ', $strFilters);
    }
    
    public function findOneBy(array $filters) {
        $result = $this->findBy($filters);
        if(count($result) > 0) {
            return $result[0];
        }
        
        return null;
    }

}
