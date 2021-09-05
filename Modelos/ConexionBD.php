<?php

class ConexionBD
{

    public function cBD()
    {

        $bd = new PDO("mysql:host=localhost;dbname=clinica", "remto", "v123456");

        $bd->exec("set names utf8");

        return $bd;

    }

}
