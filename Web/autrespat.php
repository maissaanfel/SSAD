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

    $id = $data_profile['idMedecin'];
    $ids = $data_profile['idService'];
    $idHop = $data_profile['idHopital'];
 
    $pat = $bdd->prepare("SELECT * FROM patient  WHERE idMedecin != '$id' AND idService = '$ids' AND idHopital = '$idHop'  "); 
    $pat->execute();
    $data_pat = $pat->fetchAll();
?>


<!DOCTYPE html>
<html>

	<head>
		<title>Mes patients</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="autrespat.css" type="text/css"/>
	</head>
	<body>
		<nav>
			<ul>
                <li><a class="a1" href="profilmed.php">Mon profil</a></li>
                <li><a href="mespatientsmed.php">Mes patients</a></li>
                <li><a class="a2" href="autrespat.php">Autres patients</a></li>
                <li><a href="autres.php">Autres</a></li>
                <li><a href="deconnexion.php"> deconnexion </a></li>
			</ul>
		</nav>
        <main class="main">
            <table border="1" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Médecin</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data_pat as $d)
            {   $idp = $d['idPatient'] ;
                $idm = $d['idMedecin'] ;
                $med = $bdd->prepare("SELECT * FROM medecin  WHERE idMedecin = '$idm' "); 
                $med->execute();
                $data_med = $med->fetch();
                $mede = $data_med['Nom'];
                $idH = $d['idHopital'];
                $hop = $bdd->prepare("SELECT * FROM hopital  WHERE idHopital = '$idH' "); 
                $hop->execute();
                $data_hop = $hop->fetch(); ?>
                <tr>
                <td><?php echo $idp?> </td>
                <td><?php echo $mede?> </td>
                <td><a <?php if( $data_hop['wilaya'] < 30 ) { ?> href="rapportmed1.php?d=<?=$idp?>" <?php }else{ ?>href="rapportmed2.php?d=<?=$idp?>"<?php } ?> > Consulter </a></td>
                </tr>
                <?php } ?> 
            </table>
        </main>
        </footer>
	<body>
</html>						