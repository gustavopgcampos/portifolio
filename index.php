<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'https://gustavopgcampos.github.io/portifolio/');

// define valor padrão para as variáveis
View::init([
    'URL'=> URL
]);

$obRouter = new Router(URL);   

//inclui as rotas de páginas
include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();