<?php 
    session_start();             
    require_once 'datab.php';
    
    if(!isset($_SESSION['user']))
    {
        header('Location:auth.php'); 
        die();
    }
    $email = ($_SESSION['user']);
    $profile = $bdd->prepare("SELECT * FROM secretaire  WHERE email = ? "); 
    $profile->execute(array($email));
    $data_profile = $profile->fetch();

    $ids = $data_profile['idService'];
    $idh = $data_profile['idHopital'];

    $pat = $bdd->prepare("SELECT * FROM patient  WHERE idService = '$ids' AND idHopital ='$idh' AND archive ='oui' "); 
    $pat->execute();
    $data_pat = $pat->fetchAll();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Consulter</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="archives.css" type="text/css"/>
	</head>
	<body>
    <nav class="nav">
			<ul>
                <li><a class="a1" href="profilsec.php">Mon profil</a></li>
                <li><a href="mespatientsec.php">Mes patients</a></li>
                <li><a class="a2" href="archives.php">Les archives</a></li>
                <li><a href="deconnexion.php"> deconnexion </a></li>
			</ul>
		</nav>
        <main class="main">
            <table border="1" cellspacing="0">
                <tr>
                    <th>ID </th>
                    <th>Nom </th>
                    <th>Prenom</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data_pat as $d)
                {   
                $idp= $d['idPatient'];
                $hop = $bdd->prepare("SELECT * FROM hopital  WHERE idHopital = '$idH' "); 
                $hop->execute();
                $data_hop = $hop->fetch();
                ?>
                <tr>
                    <td> <?php echo $d['idPatient'] ?> </td>
                    <td>  <?php echo $d['nom'] ?>  </td>
                    <td> <?php echo $d['prenom'] ?> </td>
                    <td><a href="desarchive.php?d=<?=$idp?>" > <button type="submit" class="btn"> Désarchiver le dossier </button> </a> </td>
                </tr>
                <?php } ?> 
            </table>
        </main>
	<body>
</html>						