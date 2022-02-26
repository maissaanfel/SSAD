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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier</title>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="modifiermed1.css" type="text/css"/>
    </head>
    <body>
        <nav>
			<ul>
                <li><a class="a1" href="profilmed.php">Mon profil</a></li>
                <li><a class="a2" href="mespatientsmed.php">Mes patients</a></li>
                <li><a href="autrespat.php">Autres patients</a></li>
                <li><a href="autres.php">Autres</a></li>
                <li><a href="deconnexion.php"> deconnexion </a></li>
			</ul>
		</nav>
        <main class="main">
        <form method="POST" action="add1.php?idp=<?=$id?>">
        <label  for="tp"> Taille :</label>
            <input type="text" id="tp" name="taille"/><br/>
            <label  for="tp"> Poids :</label>
            <input type="text" id="tp" name="poids"/><br/>
            <label  for="tp"> Tension :</label>
            <input type="text" id="tp"  name="tens"/><br/>
            <label  for="mc"> Antécedents :</label><br/>
            <textarea id="mc" name="ant" rows="5" cols="40"></textarea><br/>
            <label  for="obs"> Observation :</label>
            <input type="text" id="obs" name="obs"/><br/>
            <label  for="diag"> Diagnostique :</label><br/>
            <textarea id="diag" name="diag" rows="5" cols="40"></textarea><br/>
            <label  for="anal"> Analyse :</label><br/>
            <textarea id="anal" name="ana" rows="10" cols="40">  </textarea><br/>
            <label  for="exam"> Examen médical :</label><br/>
            <textarea id="exam" name="exam" rows="5" cols="40"> </textarea><br/>
            <label  for="res"> Résultat :</label><br/>
            <textarea id="res" name="res" rows="10" cols="40"></textarea><br/>
            <label  for="com"> Commentaire :</label>
            <input type="text" id="com"  name="com"/><br/>
            <label  for="dateConsult"> Date de Consultation :</label>
            <input type="date" id="date" name="dateConsult" min="1920-01-01" max="2023-01-01" /><br/>
            <button class="btn1">Enregistrer la modification</button>
            <button class="btn2">Annuler</button>
        </form>
        </main>
    </body>
</html>