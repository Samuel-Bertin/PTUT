<?php 

    
session_start();

$_SESSION['erreurs_info'] = array();

verifVariables();

if (isset($_POST['creer'])) {
    if (empty($_SESSION['erreurs_info'])) {
        header('Location: ajout_points_nouveau_parcours.php');
    } else {
        header('Location: ../html/add.html');
    }
    
} else {
    if (isset($_POST['ajouter'])) {
        //si la taille du tableau $_SESSION['erreurs_info'] est vide, on peut ajouter le parcours
        if (empty($_SESSION['erreurs_info'])) {
            header('Location: ../html/addTo.html');
        } else {
            header ('Location: ../html/add.html');
        }
        
    }
}

function verifVariables() {

    if (isset($_POST['nom'])) {
        $nom = $_POST['nom'];
        //Le nom ne doit contenir que des lettres, des chiffres ou des espaces et doit faire entre 2 et 50 caractères
        if (!preg_match("/^[0-9a-zA-Z áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{2,50}$/", $nom)) {
            $_SESSION['erreurs_info']['nom'] = "Le nom doit contenir entre 2 et 50 caractères non numériques";
        } else {
            //unset 
            unset($_SESSION['erreurs_info']['nom']);
        }
           $_SESSION['nom'] = $nom;
    } else {
        $_SESSION['erreurs_info']['nom'] = "Veuillez entrer un nom";
    }
 

    if (isset($_POST['desc'])) {
        $description = $_POST['desc'];
    } else {
        $description = "";
    }
    $_SESSION['desc'] = $description;

    if (isset($_POST['add_image'])) {
        $image = $_POST['add_image'];
    } else {
        $image = null;
    }
    $_SESSION['add_image'] = $image;

    if (isset($_POST['distance'])) {
        $distance = $_POST['distance'];
        //enlever "km" de la string $distance
        $distance = str_replace(" km", "", $distance);
        // la distance doit être un nombre
        if (!is_numeric($distance)) {
            unset($_SESSION['erreurs_info']['distance']);
            $_SESSION['erreurs_info']['distance'] = "La distance doit être un nombre";
        } else {
            //unset 
            unset($_SESSION['erreurs_info']['distance']);
        }
        $_SESSION['distance'] = $distance;
    } else {
        $_SESSION['erreurs_info']['distance'] = "La distance est obligatoire";
    }
    

    if (isset($_POST['duree'])) {
        $duree = $_POST['duree'];
        //La durée ne peut contenir que des valeurs numériques et faire au moins un caractere
        if (!preg_match('/^[0-9:]*$/', $duree)) {
            unset($_SESSION['erreurs_info']['duree']);
            $_SESSION['erreurs_info']['duree'] = "La durée doit contenir que des chiffres";
        } else if (strlen($duree) == 0) {
            $_SESSION['erreurs_info']['duree'] = "La durée doit contenir au moins un caractere";
        } else {
            //unset 
            unset($_SESSION['erreurs_info']['duree']);
        }
    } else {
        $duree = "0";
    }
    $_SESSION['duree'] = $duree;

    if (isset($_POST['denivele'])) {
        $denivele_parcours = $_POST['denivele'];
        //Le denivele ne peut contenir que des valeurs numérique, des points et faire au moins un caractere
        if (!preg_match('/^[0-9.]*$/', $denivele_parcours)) {
            unset($_SESSION['erreurs_info']['denivele']);
            $_SESSION['erreurs_info']['denivele'] = "Le denivele doit contenir que des chiffres";
        } else if (strlen($denivele_parcours) == 0) {
            $_SESSION['erreurs_info']['denivele'] = "Le denivele doit contenir au moins un caractere";
        } else {
            //unset 
            unset($_SESSION['erreurs_info']['denivele']);
        }
        $_SESSION['denivele'] = $denivele_parcours;
    } else {
        //erreur si le denivele n'est pas renseigné
        $_SESSION['erreurs_info']['denivele'] = "Le denivele est obligatoire";
    }
    

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date_parcours = $_POST['date'];
        unset($_SESSION['erreurs_info']['date']);
         $_SESSION['date'] = $date_parcours;
    } else {
        //La date ne doit pas etre vide
        $_SESSION['erreurs_info']['date'] = "La date est obligatoire";
    }
    

    if (isset($_POST['ville']) && !empty($_POST['ville'])) {
        $ville_parcours = $_POST['ville'];
        unset($_SESSION['erreurs_info']['ville']);
        $_SESSION['ville'] = $ville_parcours;
    } else {
        //La ville ne doit pas etre vide
        $_SESSION['erreurs_info']['ville'] = "La ville est obligatoire";
    }
    

    if (isset($_POST['activite']) && !empty($_POST['activite'])) {
        $activite = $_POST['activite'];
        //l'activite ne doit pas contenir des nombres ni etre vide  
        if (!preg_match('/^[a-zA-Z áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/', $activite)) {
            unset($_SESSION['erreurs_info']['activite']);
            $_SESSION['erreurs_info']['activite'] = "L'activite doit contenir que des lettres";
        }
         $_SESSION['activite'] = $activite;
    } else {
        //le nom d'activité de doit pas etre vide
        $_SESSION['erreurs_info']['activite'] = "L'activite est obligatoire";
    }
   

    if (isset($_POST['meteo'])) {
        $meteo = $_POST['meteo'];
    } else {
        $meteo = "";
    }
    $_SESSION['meteo'] = $meteo;

    if (isset($_POST['ht'])) {
        $ht = $_POST['ht'];
    } else {
        $ht = "";
    }
    $_SESSION['ht'] = $ht;

    if (isset($_POST['group'])) {
        $group = $_POST['group'];
    } else {
        $group = "";
    }
    $_SESSION['group'] = $group;
    
}

?>