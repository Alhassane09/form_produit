<?php 

class Connexion extends PDO{

    public function __construct($dsn ="mysql:host=localhost;dbname=magasin", $user="root", $password="", $options=[])
    {
        parent::__construct($dsn, $user, $password, $options);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>