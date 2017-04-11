<?php
class Route
{
    private $regex;
    private $controller;
    private $expectedParameters;
    private $method;

    /**
     * Route constructor.
     * @param string $regex
     * @param Controller $controller
     */
    public function __construct($regex, $controller, $method, $paramNbr)
    {
        $this->regex = $regex;
        $this->controller = $controller;
        $this->method = $method;
        $this->expectedParameters = $paramNbr;
    }

    /**
     * Check if the given url match with the route
     * @param string $str
     * The URL to analyse
     * @return array|bool
     */
    public function match($str){
        preg_match_all($this->getRegex(),$str,$result);
        if($this->method != "ALL" && $this->method != $_SERVER['REQUEST_METHOD']){
            return false;
        }
        if(count($result[0]) == 0){
            return false;
        }
        if($this->getExpectedParameters() > 0 &&
            (!isset($result[1]) || count($result[1]) < $this->getExpectedParameters())){
            return false;
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @return Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return int
     */
    public function getExpectedParameters()
    {
        return $this->expectedParameters;
    }

    /**
     * @param int $expectedParameters
     */
    public function setExpectedParameters($expectedParameters)
    {
        $this->expectedParameters = $expectedParameters;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

}