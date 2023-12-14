<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function login($username, $password, $userType)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' AND `USER_TYPE` = '$userType'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
}
