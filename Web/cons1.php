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
$pat = $bdd->prepare("SELECT * FROM patient  WHERE idPatient = '$id' "); 
$pat->execute();
$data_pat = $pat->fetch();
}

$idH = $data_pat['idHopital'];
$hop = $bdd->prepare("SELECT * FROM hopital  WHERE idHopital = '$idH' "); 
$hop->execute();
$data_hop = $hop->fetch();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consulter</title>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="consultermed1.css" type="text/css"/>
    </head>
    <body>
        <nav>
        <ul>
                <li><a class="a1" href="profiladmg.php">Mon profil</a></li>
                <li><a href="infospers.php">Informations personnelles </a></li>
                <li><a href="infosmed.html">Informations médicales </a></li>
			</ul>
		</nav>
        <?php if( $data_hop['wilaya'] < 30 ) { ?> 
        <main class="main">
            <p><span>ID : <?php echo $data_pat['idPatient'] ?> </span> </p>
            <p><span>NOM : <?php echo $data_pat['nom'] ?> </span> </p>
            <p><span>PRENOM : <?php echo $data_pat['prenom'] ?></span> </p>
            <p><span>GENRE : <?php echo $data_pat['genre'] ?></span> </p>
            <p><span>DATE DE NAISSANCE : <?php echo $data_pat['dateN'] ?> </span> </p>
            <p><span>EMAIL :</span> <?php echo $data_pat['email'] ?> </p>
            <p><span>NUMERO DE TELEPHONE 01 :</span> <?php echo $data_pat['tel1'] ?> </p>
            <p><span>NUMERO DE TELEPHONE 02 :</span> <?php echo $data_pat['tel2'] ?> </p>
            <p><span>GROUPE SANGUIN :</span> <?php echo $data_pat['grp-sanguin'] ?> </p>
        </main>
        <?php }else{ ?> 
            <main class="main">
            <p><span>ID : <?php echo $data_pat['idPatient'] ?> </span> </p>
            <p><span>NOM : <?php echo $data_pat['nom'] ?> </span> </p>
            <p><span>PRENOM : <?php echo $data_pat['prenom'] ?></span> </p>
            <p><span>GENRE : <?php echo $data_pat['genre'] ?></span> </p>
            <p><span>DATE DE NAISSANCE : <?php echo $data_pat['dateN'] ?> </span> </p>
            <p><span>EMAIL :</span> <?php echo $data_pat['email'] ?> </p>
            <p><span>NUMERO DE TELEPHONE 01 :</span> <?php echo $data_pat['tel1'] ?> </p>
            <p><span>GROUPE SANGUIN :</span> <?php echo $data_pat['grp-sanguin'] ?> </p>
        </main>
        <?php } ?>
    </body>
</html>

