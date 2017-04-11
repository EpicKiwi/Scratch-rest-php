<?php

class JsonError implements JsonSerializable
{
    private $code;
    private $message;

    /**
     * JsonError constructor.
     * @param $code
     * @param $message
     */
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    function jsonSerialize()
    {
        return ["err"=>["code"=>$this->getCode(),"message"=>$this->getMessage()]];
    }

    function send(){
        http_response_code($this->code);
        header('Content-Type: application/json');
        echo json_encode($this);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


}