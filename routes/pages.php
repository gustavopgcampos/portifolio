<?php


use \App\Http\Response;
use \App\Controller\Pages;

    //rota da home
    $obRouter->get ('/', [
       function () 
        {
            return new Response(200, Pages\Home::getHome());
        }
    ]);

    $obRouter->get ('/sobre', [
       function () 
        {
            return new Response(200, Pages\About::getHome());
        }
    ]);
    
    $obRouter->get ('/projetos', [
       function () 
        {
            return new Response(200, Pages\Projects::getHome());
        }
    ]);

