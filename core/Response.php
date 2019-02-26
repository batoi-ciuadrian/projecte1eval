<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\core;
use cursophp7\core\App;
/**
 * Description of Response
 *
 * @author Adrian Ciucurenco
 */
class Response {
    public static function renderView(string $name, string $layout = 'layout', array $data = []) {
        extract($data);
        
        $app['user'] = App::get('appUser');
        
        ob_start();
        
        require __DIR__."/../app/views/$name.view.php";
        
        $mainContent = ob_get_clean();
        
        require __DIR__."/../app/views/$layout.view.php";
    }
}
