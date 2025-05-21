<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home extends Page
{
    
    public static function getHome()
    {
        $content = View::render('pages/home', [
            'name'=>'gustavo'
        ]);
        
        return parent::getPage('portifolio for real', $content);
    }
    
} 
