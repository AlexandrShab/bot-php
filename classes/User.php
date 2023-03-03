<?php
require_once __DIR__ . '/BaseAPI.php';

class User
{
    public $is_admin;
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $date;

    
    public function __construct($arrUser)
    {
        foreach ($arrUser as $key => $value) 
        {
                $this->$key = $value;
        }
    }
    public function setAsAdmin()
    {
        $base = new Connect;
        $query = "UPDATE `users` SET is_admin=1 WHERE id ='$this->id';";
        
        $data = $base->prepare($query);
        $data->execute();
        
        return true;
    }
    public function unsetAsAdmin()
    {
        $base = new Connect;
        $query = "UPDATE `users` SET is_admin=0 WHERE id ='$this->id';";
        
        $data = $base->prepare($query);
        $data->execute();
        
        return true;
    }
    public function update($arrUser)
    {
        $base = new Connect;
        $id = $arrUser["id"];
        $first_name = $arrUser["first_name"];
        $last_name = $arrUser["last_name"];
        $username = $arrUser["username"];
        $query = "UPDATE `users` SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id ='$id';";
        $data = $base->prepare($query);
        $data->execute();
        
        return true;
    }
    public function getNameAsTgLink()
    {
        
    }
}