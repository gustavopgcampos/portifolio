<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{
    // método responsável por retornar o conteúdo da página
    public static function getPage ($title, $content) 
    {
        return View::render('pages/page', [
            'title'=> $title, 
            'content'=> $content,
            'header' => self::getHeader(), 
            'footer' => self::getFooter()
        ]);
    }
    
    private static function getHeader ()
    {
        return View::render ('pages/header');
    }
    
    private static function getFooter () 
    {
        return View::render('pages/footer');
    }
}
