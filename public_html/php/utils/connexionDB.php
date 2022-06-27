<?php

     function connexion(){
        $path = 'C:\xampp\htdocs\PTUT\public_html\php';
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        require('config.php');

        try {
            $linkpdo = new PDO("mysql:host=$host;dbname=$db", $user,$pwd);
            $linkpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $linkpdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return $linkpdo;

    }
?>