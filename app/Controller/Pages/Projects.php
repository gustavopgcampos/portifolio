<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Projects extends Page 
{
    public static function getHome()
    {
        $content = View::render('pages/projects', [
            'name'=>'teste'
        ]);
        
        return parent::getPage('Gustavo Pereira - Projetos', $content);
    }
}
