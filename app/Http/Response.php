<?php

namespace App\Http;

class Response 
{
    // código do status http
    private $httpCode = 200;
    
    // cabeçalho do response
    private $headers = [];
    
    // guarda o tipo do conteúdo que está sendo retornado
    private $contentType = 'text/html';
    
    // conteúdo do response
    private $content; 
    
    // responsável por iniciar a classe com valores definidos
    public function __construct ($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->contentType = $contentType;
        $this->setContentType($contentType);
    }
    
    // método responsável por alterar o contentType do response
    public function setContentType ($contentType)
    {
        $this->contentType = $contentType;
        
        $this->addHeader('Content-Type', $contentType); 
    }
    
    // método responsável por adicionar um registro no cabeçalho de response
    public function addHeader ($key, $value) 
    {
        $this->headers[$key] = $value;
    }
    
    // método responsável por enviar a resposta para o usuário (validar o tipo de conteudo e retornar ao usuário)
    public function sendResponse () 
    {
        //envia os headers
        $this->sendHeaders();
        
        //imprime o conteúdo 
        switch ($this->contentType) 
        {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
    
    // metodo responsável por enviar os headers para o navegador
    private function sendHeaders ()
    {
        // pega o status da página
        http_response_code($this->httpCode);
        
        // envia os headers
        foreach ($this->headers as $key=>$value) 
        {
            header($key.': '.$value);
        }
    }
}
