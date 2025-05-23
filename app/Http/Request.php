<?php

namespace App\Http;

class Request 
{
    // método http da requisição
    private $httpMethod;
    
    // uri da página(rota)
    private $uri;
    
    // parâmetros da url ($_URL)
    private $queryParams = [];
    
    // variáveis recebidas no post da página($_POST)
    private $postVars = [];
    
    //guarda o cabeçalho da requisição
    private $headers = [];
    
    // construtor da classe
    public function __construct() 
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
    
    // método que retorna o método HTTP da requisição 
    public function getHttpMethod () 
    {
        return $this->httpMethod;
    }
    
    // método que retorna a URI da requisição
    public function getUri () 
    {
        return $this->uri;
    }
    
    // método que retorna o cabeçalho da requisição
    public function getHeaders () 
    {
        return $this->headers;
    }
    
    // método que retorna os parâmetros da url da requisição 
    public function getQueryParams () 
    {
        return $this->queryParams;
    }
    
    // método que retorna as variáveis post da requisição
    public function getPostVars () 
    {
        return $this->postVars;
    }
}
