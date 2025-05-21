<?php

namespace App\Utils;

class View 
{
    // retorna o conteúdo de uma view
    private static function getContentView ($view) 
    {
        // pega o nome do arquivo da view e concatena .html
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        
        // se o arquivo existir, ele pega o conteúdo do arquivo, caso contrário retorna uma string vazia
        return file_exists($file) ? file_get_contents($file) : '';
    }
    
    // retorna o conteúdo renderizado de uma view
    public static function render ($view, $vars = []) 
    {
        $contentView = self::getContentView($view);
        
        // mapeia o array com as variáveis
        $keys = array_keys($vars);
        
        // concatena {{ e }} à variável para ser utilizada
        $keys = array_map(function($item ){
            return '{{'.$item.'}}';
        }, $keys);
                
        return str_replace($keys, array_values($vars), $contentView);
    }
}
