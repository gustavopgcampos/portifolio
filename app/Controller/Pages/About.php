<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class About extends Page
{
    public static function getHome () 
    {
        $content = View::render ('pages/about', [
            //decidir o que passar aqui dentro como variável 
        ]); 
        
        return parent::getPage('Gustavo Pereira - Sobre', $content);
    }
}





    

