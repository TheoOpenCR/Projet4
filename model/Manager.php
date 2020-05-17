<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=roman_jean;charset=utf8', 'root', 'root');
        return $db;
    }
}