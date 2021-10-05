<?php

class CustomView extends \Slim\View {
    
    public function render($template, $data=null) {
        //GENERA EL HTML DEL TEMPLATE RECIBIDO Y LO GUARGA EN LA VARIABLE MAIN.
        ob_start();
        require "./src/Views/". $template .".php";
        $main = ob_get_clean();

        //GENERA EL HTML COMPLETO DE LA VISTA, AGREGANDO LA SECCIÓN DEL MAIN EN ELL BODY.
        ob_start();
        require "./src/Views/index.php";
        $html = ob_get_clean();

        return $html;
    }
}