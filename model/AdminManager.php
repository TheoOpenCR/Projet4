<?php
require_once(__DIR__."/Manager.php");

class AdminManager extends Manager
{
    public function getLogin($username)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE username = :username');
        $req->execute([
            'username' =>$username
        ]);

        $user = $req->fetch();

        return $user;
    }

}