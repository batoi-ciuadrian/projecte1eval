<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlashMessage
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\core\helpers;

class FlashMessage {
    public static function get(string $key, $default = '') {
        if (isset($_SESSION['flash-message'])) {
            $value = $_SESSION['flash-message'][$key] ?? $default;
            unset($_SESSION['flash-message'][$key]);
        } else {
            $value = $default;
        }
        
        return $value;
    }
    
    public static function set(string $key, $value) {
        $_SESSION['flash-message'][$key] = $value;
    }
    
    public static function noset(string $key) {
        if (isset($_SESSION['flash-message'])) {
            unset($_SESSION['flash-message'][$key]);
        }
    }
}
