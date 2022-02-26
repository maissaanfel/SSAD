<?php 

    session_start();              
    require_once 'datab.php';
    
    if(!isset($_SESSION['user']))
    {
        header('Location:index3.php'); 
        die();
    }
    
    if(isset($_GET['idp']))
    {
    $idp=$_GET['idp'];
    $ciphering = "AES-128-CTR";
    $option = 0;
    $encryption_key = "Iv39eptJvuhAq5srTo7mFqiZcuwXq1n0";
    $encryption_iv = "1234567890123456";
    $taille = ($_POST['taille']);
    $taillec = openssl_encrypt($taille,$ciphering,$encryption_key,$option,$encryption_iv);
    $poids = ($_POST['poids']);
    $poidsc = openssl_encrypt($poids,$ciphering,$encryption_key,$option,$encryption_iv);
    $tens = ($_POST['tens']);
    $tensc = openssl_encrypt($tens,$ciphering,$encryption_key,$option,$encryption_iv);
    $ant = ($_POST['ant']);
    $antc = openssl_encrypt($ant,$ciphering,$encryption_key,$option,$encryption_iv);
    $obs = ($_POST['obs']);
    $obsc = openssl_encrypt($obs,$ciphering,$encryption_key,$option,$encryption_iv);
    $diag = ($_POST['diag']);
    $diagc = openssl_encrypt($diag,$ciphering,$encryption_key,$option,$encryption_iv);
    $ana = ($_POST['ana']);
    $anac = openssl_encrypt($ana,$ciphering,$encryption_key,$option,$encryption_iv);
    $exam = ($_POST['exam']);
    $examc = openssl_encrypt($exam,$ciphering,$encryption_key,$option,$encryption_iv);
    $res = ($_POST['res']);
    $resc = openssl_encrypt($res,$ciphering,$encryption_key,$option,$encryption_iv);
    $com = ($_POST['com']);
    $comc = openssl_encrypt($com,$ciphering,$encryption_key,$option,$encryption_iv);
    $date = ($_POST['dateConsult']);

    $dep = $bdd->prepare("INSERT INTO consultation (`taille`,`poids`,`tension`,`antecedents`,`maladiesChroniques`,`observation`,`diagnostic`,`analyse`,`examenMedical`,`resultat`,`commentaire`,`dateConsult`,`idPatient`) VALUES ('$taillec','$poidsc','$tensc','$antc','','$obsc','$diagc','$anac','$examc','$resc','$comc','$date','$idp') ;");
    $res=$dep->execute();

    }

    if($res)
    { 
      header('Location:mespatientsmed.php?add=oui');
    }else
    {
      header('Location:mespatientsmed.php?add=non');
    } 