<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home extends Page
{
    
    public static function getHome()
    {
        $about = View::render('pages/about');
        $projects = View::render('pages/projects');
        
        $content = View::render('pages/home', [
            'about' => $about, 
            'projects'=> $projects
        ]);
        
        return parent::getPage('Gustavo Pereira - Portifollio', $content);
    }
    
} 
