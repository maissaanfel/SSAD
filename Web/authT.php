<?php 
// ATTENTION !!! ne pass toucher à ce bout de code //
    session_start();              //ouverture de la séance.
    require_once 'datab.php';       //appel de la database
    
    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['fct']))
    {   
        $fct = ($_POST['fct']);
        $date = ($_POST['date_naiss']);
        $email = ($_POST['email']);
        $password = ($_POST['password']);
        $a='med';
        $b='sec';
        $c='adm';
        $d='admg';

        if( $fct === $a )
        {
        $stmt = $bdd->prepare("SELECT * FROM medecin  WHERE email = '$email' ");  //le prepare prépare une requête à l'exécution et retourne un objet PDOStatement qui est $stmt dans ce cas.
        $stmt->execute();               //executer le pdo statement qui est stmt
        $data = $stmt->fetch();                //$data est de type Array et contient le résultat du fetch
        $passwordh = $data['mdp'];
        $row = $stmt->rowCount();         // rowCount retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
        if($row == 1)                //si 1 ligne est affecté c.à.d l'émail est selectionné et donc existe dans la base de donnée
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))         //vérifier qque c'est une adresse valide.
            {
                if(password_verify($password,$passwordh) && $date === $data['data_naiss'])       //si le mot de passe est bon.
                {
                   //création des variables de session.
                    $_SESSION['user'] = $data['email'];
                    header('Location: profilmed.php');          //aller vers l'espace membre
                    die();
                }else{ header('Location: auth.php?login_err=password'); die(); }
            }else{ header('Location: auth.php?login_err=email'); die(); }  
        }else{ header('Location: auth.php?login_err=nonexistant'); die(); }
        }elseif($fct === $b )
        {
        $stmt = $bdd->prepare("SELECT * FROM secretaire WHERE email = '$email' ");  //le prepare prépare une requête à l'exécution et retourne un objet PDOStatement qui est $stmt dans ce cas.
        $stmt->execute();               //executer le pdo statement qui est stmt
        $data = $stmt->fetch();                //$data est de type Array et contient le résultat du fetch
        $passwordh = $data['mdp'];
        $row = $stmt->rowCount();         // rowCount retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
        if($row == 1)                //si 1 ligne est affecté c.à.d l'émail est selectionné et donc existe dans la base de donnée
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))         //vérifier qque c'est une adresse valide.
            {
                if(password_verify($password,$passwordh) && $date === $data['data_naiss'])       //si le mot de passe est bon.
                {
                   //création des variables de session.
                    $_SESSION['user'] = $data['email'];
                    header('Location: profilsec.php');          //aller vers l'espace membre
                    die();
                }else{ header('Location: auth.php?login_err=password'); die(); }
            }else{ header('Location: auth.php?login_err=email'); die(); }  
        }else{ header('Location: auth.php?login_err=nonexistant'); die(); }
        }
        elseif($fct === $c )
        {
        $stmt = $bdd->prepare("SELECT * FROM administrateur WHERE email = '$email' ");  //le prepare prépare une requête à l'exécution et retourne un objet PDOStatement qui est $stmt dans ce cas.
        $stmt->execute();               //executer le pdo statement qui est stmt
        $data = $stmt->fetch();                //$data est de type Array et contient le résultat du fetch
        $passwordh = $data['mdp'];
        $row = $stmt->rowCount();         // rowCount retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
        if($row == 1)                //si 1 ligne est affecté c.à.d l'émail est selectionné et donc existe dans la base de donnée
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))         //vérifier qque c'est une adresse valide.
            {
                if($password = $passwordh && $date === $data['data_naiss'])       //si le mot de passe est bon.
                {
                   //création des variables de session.
                    $_SESSION['user'] = $data['email'];
                    header('Location: profiladmh.php');          //aller vers l'espace membre
                    die();
                }else{ header('Location: auth.php?login_err=password'); die(); }
            }else{ header('Location: auth.php?login_err=email'); die(); }  
        }else{ header('Location: auth.php?login_err=nonexistant'); die(); }
        }elseif($fct === $d )
        {
        $stmt = $bdd->prepare("SELECT * FROM ministeresante WHERE email = '$email' ");  //le prepare prépare une requête à l'exécution et retourne un objet PDOStatement qui est $stmt dans ce cas.
        $stmt->execute();               //executer le pdo statement qui est stmt
        $data = $stmt->fetch();                //$data est de type Array et contient le résultat du fetch
        $passwordh = $data['mdp'];
        $row = $stmt->rowCount();         // rowCount retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
        if($row == 1)                //si 1 ligne est affecté c.à.d l'émail est selectionné et donc existe dans la base de donnée
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))         //vérifier qque c'est une adresse valide.
            {
                if(password_verify($password,$passwordh) && $date === $data['data_naiss'])       //si le mot de passe est bon.
                {
                   //création des variables de session.
                    $_SESSION['user'] = $data['email'];
                    header('Location: profiladmg.php');          //aller vers l'espace membre
                    die();
                }else{ header('Location: auth.php?login_err=password'); die(); }
            }else{ header('Location: auth.php?login_err=email'); die(); }  
        }else{ header('Location: auth.php?login_err=nonexistant'); die(); }
        }
    }
    