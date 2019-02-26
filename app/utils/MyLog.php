<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyLog
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\utils;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyLog {
    private $log;
    
    private $level;
    
    /**
     * 
     * @param string $filename
     */
    private function __construct(string $filename, int $level) {
        $this->log = new Logger('name');
        $this->level = $level;
        $this->log->pushHandler(
                new StreamHandler($filename, $this->level)
                );
    }
    
    /**
     * 
     * @param string $filename
     * @return \MyLog
     */
    public static function load(string $filename, int $level = Logger::INFO) : MyLog {
        return new MyLog($filename, $level);
    }
    
    /**
     * 
     * @param string $message
     */
    public function add(string $message) :void {
        $this->log->log($this->level, $message);
    }

}
