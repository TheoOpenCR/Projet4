<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=webagenczbtheo35.mysql.db;dbname=webagenczbtheo35;charset=utf8', 'webagenczbtheo35', 'Theo1809');
        return $db;
    }
}