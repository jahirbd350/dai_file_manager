<?php


namespace App\classes;


class Database
{
    public static function db_connect(){
        return $link = mysqli_connect('localhost','root','','dai_file_manager');
    }
}