<?php
 session_start();
 require("utils/connexionDB.php");

 //if (isset($_SESSION['login']))
// header("location:../public/index.html");

    if((!empty($_POST['token']) && (!empty($_POST['email'])))){

        $linkpdo= connexion();

        $mail = $_POST['email'];
        $req =$linkpdo->prepare('Select tokeninit from Utilisateur where mail = :mail');

        $req -> execute(array('mail' =>$mail));

        $reset = $req ->fetch();
        $_SESSION['mailtoken'] = $_POST["email"];
        if($_POST['token'] == $reset[0]){
            
            header('Location:../html/changementMDP.html?token='.$reset[0]);
        }else{
            header('Location:../html/token.html?error=token&email='.$_POST["email"]);
        }
    }else{
        header('Location:../html/token.html?error=token&email='.$_POST["email"]);
    }