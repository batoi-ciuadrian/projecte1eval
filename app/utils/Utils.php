<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\utils;

/**
 * Description of Utils
 *
 * @author Adrian Ciucurenco
 */
class Utils {
    public static function esOpcionMenuActiva(string $opcionMenu) :bool {
        if (strpos($_SERVER['REQUEST_URI'], $opcionMenu) !== false) {
            return true;
        }
        
        return false;
    }
    
    public static function existeOpcionMenuActivaEnArray(array $opcionesMenu) :bool {
        foreach ($opcionesMenu as $opcionMenu) {
            if (self::esOpcionMenuActiva($opcionMenu) === true) {
                return true;
            }
            
            return false;
        }
    }
    
    public static function extraerAleatorio($array, int $num) {
        shuffle($array);
        return array_chunk($array, $num)[0];
    }
}
