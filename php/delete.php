<?php

        require('connexionDB.php'); 
    
        session_start();

        $linkpdo = connexion();
        $req = (" DELETE FROM fichier where id_fichier =".$_GET['id_fichier'] );
        $res = $linkpdo->prepare($req);
        $res->execute();

        unlink('fichiers_telecharges/'.$_GET['id_fichier'].'.gpx');

        $req = (" select count(id_fichier) as nb_fichiers FROM fichier where id_parcours =".$_GET['id_parcours'] );
        $res = $linkpdo->prepare($req);
        $res->execute();
        $data = $res->fetch();

        if($data['nb_fichiers'] == 0){
            header('location:../public/index.html');
        } else{
            header('location:../public/html/show.html?id_parcours='.$_GET['id_parcours']);
        }
?>