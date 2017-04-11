<?php
include_once dirname(__FILE__)."/../classes/Model.php";
include_once dirname(__FILE__)."/../classes/singleton.php";

class UserModel implements Model, JsonSerializable
{

    private $id;
    private $username;
    private $email;
    private $role;
    private $status;

    /**
     * UserModel constructor.
     * @param $username
     * @param $email
     * @param $role
     * @param $status
     */
    public function __construct($username, $email, $role, $status)
    {
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->status = $status;
    }

    public static function findAll(){
        $pdo = singleton::getInstance();
        $rawResult = $pdo->query("SELECT * FROM users")
                         ->fetchAll();

        $result = [];
        foreach ($rawResult as $line){
            $newObject = new self($line["username"],
                                  $line["user_email"],
                                  $line["user_role"],
                                  $line["user_status"]);
            $newObject->setId($line["id"]);
            array_push($result,$newObject);
        }
        return $result;
    }

    public static function findOne($id){
        $pdo = singleton::getInstance();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $statement->execute(["id"=>$id]);
        $rawResult = $statement->fetch();
        if($rawResult) {
            $newObject = new self($rawResult["username"],
                $rawResult["user_email"],
                $rawResult["user_role"],
                $rawResult["user_status"]);
            $newObject->setId($rawResult["id"]);

            return $newObject;
        } else {
            return null;
        }
    }

    public function save(){
        $pdo = singleton::getInstance();
        $parameters = ["username"=>$this->getUsername(),
            "email"=>$this->getEmail(),
            "role"=>$this->getRole(),
            "status"=>$this->getStatus()];
        if($this->id > 0){
            $statement = $pdo->prepare("UPDATE users SET username = :username, user_email = :email, user_role = :role, user_status = :status WHERE id = :id");
            $parameters["id"] = $this->getId();
        } else {
            $statement = $pdo->prepare("INSERT INTO users(username, user_email, user_role, user_status) VALUES (:username, :email, :role, :status)");
        }

        return $statement->execute($parameters);
    }

    public function remove(){
        $pdo = singleton::getInstance();
        $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
        return $statement->execute(["id"=>$this->id]);
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}