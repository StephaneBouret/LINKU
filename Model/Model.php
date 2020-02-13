<?php

abstract class Model {
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "news"; 

    /**
     * Mise en place de la connexion au serveur
     * @return void
     */

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE . ";charset=UTF8", self::USER, self::PASSWORD);
            $this->connexion->exec("SET NAMES 'UTF8'");
        } catch (Exception $e) {
            echo "Echec de la connexion" . $e->getMessage();
        }
    }

    

}