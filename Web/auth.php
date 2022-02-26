<?php
session_start();
// if (isset($_SESSION["user"])){
// header('Location:Accueil/accueil.php');
// }
 ?>
<!DOCTYPE html>
<html>

	<head>
		<title>Authentification.</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 form-container">
                    <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
                        <div class="heading mb-3">
                            <h1>Connectez-vous à votre compte</h1>
                        </div>
                        <br/>
                        <?php
                    if(isset($_GET['login_err'])){
                        $err = htmlspecialchars($_GET['login_err']);
                        switch($err){
                            case 'password':
                                echo "<div class='alert alert-danger' role='alert'>Le mot de passe ou l'émail est incorrecte.</div>";
                             break;
                
                            case 'email':
                                echo "<div class='alert alert-danger' role='alert'>Le mot de passe ou l'émail est incorrecte.</div>";
                              break; 
                
                            case 'nonexistant' :
                                echo "<div class='alert alert-danger' role='alert'>Le mot de passe ou l'émail est incorrecte.</div>";
                              break;
                            
                            case 'notyet' :
                                echo "<div class='alert alert-danger' role='alert'>Vous n'avez pas accès à ce compte.</div>";
                        }
                    }
                ?> 
                        <form method="POST" action="authT.php">
                            <div class="form-input">
                                <input type="email" name="email" placeholder="Introduisez votre email" required>
                            </div>
                            <div class="form-input">
                                <input type="password" name="password" placeholder="Introduisez votre mot de passe" required>
                            </div>
                            <div class="form-input">
                                <select name="fct" id="fct">
                                    <option value="fct">Choisissez votre fonction</option>
                                    <option value="med">Medecin </option>
                                    <option value="sec">Secrétaire </option>
                                    <option value="adm">Administrateur de l'hopital </option>
                                    <option value="admg">Administrateur general </option>
                                </select><br/><br/>
                            </div>
                            <div class="form-input">
                                <input type="date" id="dateNaiss" name="date_naiss" min="1920-01-01" max="2001-01-01" />
                            </div>
                            <div class="text-left mb-3">
                                <button type="submit" class="btn btn-primary" id="log" >Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
           </div>
        </div>
    </body>
</html>						