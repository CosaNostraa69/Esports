<?php

require_once 'config.php';

class DBManager
{
    private $bdd;

    public function __construct()
    {
        try {
            $this->bdd = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
                DB_USER,
                DB_PASSWORD
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getConnexion()
    {
        return $this->bdd;
    }

}

?>