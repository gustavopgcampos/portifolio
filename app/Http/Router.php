<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router 
{
    // url completa do projeto (raíz)
    private $url = '';
    
    // prefixo de todas as rotas
    private $prefix = '';
    
    // índicie de rotas
    private $routes = [];
    
    // instância de request
    private $request;
    
    // método responsável por inciar a classe com valores
    public function __construct ($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    
    // método responsável por definir o prefixo das rotas
    private function setPrefix () 
    {
        $parseUrl = parse_url($this->url);
        
        $this->prefix = $parseUrl['path'] ?? '';
    }
        
    // método responsável por definir uma rota de GET
    public function get ($route, $params = []) 
    {
        return $this->addRoute('GET', $route, $params);
    }
    
    public function post ($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }
    
    public function put ($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }
    
    public function delete ($route, $params = []) 
    {
        return $this->addRoute('DELETE', $route, $params);
    }
    
    // método responsável por adicionar uma rota na classe (variável route)
    private function addRoute ($method, $route, $params = []) 
    {
        // validação dos parâmetros
        foreach ($params as $key=>$value)
        {
            if ($value instanceof Closure) 
            {
                $params['controller'] = $value;
                
                unset($params[$key]);
                continue;
            }
        }
        
        // padrão de validação da URL
        $patternRoute = '/^'.str_replace('/', '\/',$route).'$/';
        
        // adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
    }
    
    // método responsável por executar a rota atual
    public function run () 
    {
        try
        {
            // obtem a rota atual
            $route = $this->getRoute();
            
            //verifica se o controlador não existe
            if (!isset($route['controller'])) 
            {
                throw new Exception("A URL não pode ser processada", 500);
            }   
            
            // argumento da função
            $args = [];
                
            // retorna a execução da função 
            return call_user_func($route['controller'], $args);
            
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
    
    // método responsável por retornar os dados da rota atual
    private function getRoute () 
    {
        // pega a URI
        $uri = $this->getUri();
        
        //pega o metodo HTTP que está sendo utiizado
        $httpMethod = $this->request->getHttpMethod();
        
        //validação das rotas
        foreach ($this->routes as $patternRoute=>$method) 
        {
            //verifica se a URI bate com o padrão
            if (preg_match($patternRoute, $uri)) 
            {
                //verificar se o método bate também 
                if ($method[$httpMethod])
                {
                    return $method[$httpMethod];
                }
                
                throw new Exception("Método não permitido", 405);
            }
        }
        // URL não encontrada
        throw new Exception("URL não encontrada", 404);
    }
    
    // método responsável por retornar a URI desconsiderando o prefixo
    private function getUri()
    {
        $uri = $this->request->getUri();

        // remove prefixo se estiver no começo da URI
        if (strlen($this->prefix) && strpos($uri, $this->prefix) === 0) {
            $uri = substr($uri, strlen($this->prefix));
        }

        // garantir que não comece com barra
        return '/' . trim($uri, '/');
    }
}
