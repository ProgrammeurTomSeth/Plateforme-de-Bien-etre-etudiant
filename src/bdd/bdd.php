<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=joe;charset=utf8', 'root','');
}
catch (PDOException $e)
{ echo "Erreur :". $e->getMessage();
}