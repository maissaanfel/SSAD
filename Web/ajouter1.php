<?php 

    session_start();              
    require_once 'datab.php';
    
    if(!isset($_SESSION['user']))
    {
        header('Location:index3.php'); 
        die();
    }
    
    if(isset($_GET['d']))
    { $id = $_GET['d'] ;

     $serv = $bdd->prepare("SELECT * FROM `service` WHERE idService = '$id' "); 
     $serv->execute();
     $data_serv = $serv->fetch();

     $idh=$data_serv['idHopital'];

    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
   
    $date = ($_POST['date_naiss']);
    $email= ($_POST['email']);
    $tel1 = ($_POST['tel1']);
    $tel2 = ($_POST['tel2']);
    $med = ($_POST['med']);
    $profile = $bdd->prepare("SELECT * FROM medecin  WHERE email = '$med' "); 
    $profile->execute();
    $data_profile = $profile->fetch();
    $idmed=$data_profile['idMedecin'];
    $gs = ($_POST['gs']);


    
    $dep = $bdd->prepare("INSERT INTO patient (`nom`,`prenom`,`email`,`tel1`,`tel2`,`dateN`,`grp-sanguin`,`genre`,`idHopital`,`idService`,`idMedecin`,`archive`) VALUES ('$nom','$prenom','$email','$tel1','$tel2','$date','$gs','Homme','$idh','$id','$idmed','non') ;");
    $res=$dep->execute();

    }

    if($res)
    { 
      header('Location:mespatientsec.php?ajout=oui');
    }else
    {
        header('Location:mespatientsec.php?ajout=non');
    } 