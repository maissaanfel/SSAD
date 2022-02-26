<?php 
    session_start();             
    require_once 'datab.php';
    
    if(!isset($_SESSION['user']))
    {
        header('Location:auth.php'); 
        die();
    }
    $email = ($_SESSION['user']);
    $profile = $bdd->prepare("SELECT * FROM medecin  WHERE email = '$email' "); 
    $profile->execute();
    $data_profile = $profile->fetch();
    $ids = $data_profile['idService'] ;
    $profile2 = $bdd->prepare("SELECT * FROM medecin  WHERE idService = '$ids' AND email != '$email' "); 
    $profile2->execute();
    $data_profile2 = $profile2->fetchAll();
    $profile3 = $bdd->prepare("SELECT * FROM secretaire WHERE idService = '$ids' "); 
    $profile3->execute();
    $data_profile3 = $profile3->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consulter</title>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="autres.css" type="text/css"/>
    </head>
    <body>
        <nav>
			<ul class="ul">
                <li><a class="a1" href="profilmed.php">Mon profil</a></li>
                <li><a href="mespatientsmed.php">Mes patients</a></li>
                <li><a href="autrespat.php">Autres patients</a></li>
                <li><a class="a2" href="autres.html">Autres </a></li>
                <li><a href="deconnexion.php"> deconnexion </a></li>
			</ul>
		</nav>
        <?php foreach( $data_profile2 as $d)
        { ?>
        <main>
            <div class="gallery">
                <a><img src="inconnu.jpg"></a>
                <div class="desc">
                    <ul>
                        <li><span>Fonction :</span> <?php echo "Medecin" ?> </li><br/>
                        <li><span>Nom et Prenom :</span> <?php echo $d['Nom']."\n".$d['Prénom'] ?> </li><br/>
                        <li><span>Email :</span>  <?php echo $d['email'] ?>  </li><br/>
                        <li><span>Numéro de telephone :</span> <?php echo $d['Tel'] ?> </li><br/>
                    </ul>
                </div>
            </div>
        </main>
    <?php }?>
    <?php foreach( $data_profile3 as $d)
        { ?>
        <main>
            <div class="gallery">
                <a><img src="inconnu.jpg"></a>
                <div class="desc">
                    <ul>
                        <li><span>Fonction :</span> <?php echo "Secrétaire" ?> </li><br/>
                        <li><span>Nom et Prenom :</span> <?php echo $d['Nom']."\n".$d['Prénom'] ?> </li><br/>
                        <li><span>Email :</span>  <?php echo $d['email'] ?>  </li><br/>
                        <li><span>Numéro de telephone :</span> <?php echo $d['Tel'] ?> </li><br/>
                    </ul>
                </div>
            </div>
        </main>
    <?php }?>
    </body>
</html>