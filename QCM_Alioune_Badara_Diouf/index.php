<?php 
     session_start();

     // variables pour affichage des messages d'erreurs si l'utilisateur ne donne pas de bonne valeurs 
     $msgLoginErreur = '';
     $msgPasswordErreur = '';
     $login ='';
	 $password = '';
	 
     include('src/fonctions.php');
     if (isset($_POST['cnx'])) {
     	if (!empty($_POST['log'])) {
     		$login =$_POST['log'];
     		if (!empty($_POST['pass'])) {
     		   $password = $_POST['pass'];
			   $file = 'asset/json/jsonUsers.json';
		       $contenu = file_get_contents($file);
			   $contenu = json_decode($contenu,true);
				
			   var_dump( ( count($contenu['Admine'])+count($contenu['Joueur']) ));

			   
                for ($i =0 ; $i < ( count($contenu['Admine'])+count($contenu['Joueur']) ); $i++) { 

					if ( isset($contenu['Admine'][$i]) ) {
						if ($contenu['Admine'][$i]['login']==$login) {
							if ($contenu['Admine'][$i]['password']==$password) {
							$_SESSION['user'] = $contenu['Admine'][$i];
							header('location:views/admins/pageAdmin.php');
							}else{
								$msgPasswordErreur = "Mots de passe incorecte !!!";
								break;
							}
						}
					}
					if ( isset($contenu['Joueur'][$i]) ) {
						if ($contenu['Joueur'][$i]['login']==$login) {
							if ($contenu['Joueur'][$i]['password']==$password) {
							$_SESSION['user'] = $contenu['Joueur'][$i];
							header('location:views/joueurs/pageJoueur.php');
							}else{
								$msgPasswordErreur = "Mots de passe incorecte !!!";
								break;
							}
						}
					}
				}
     		}else{
			$msgPasswordErreur = 'Ce champ est obligatoire !!!';
   	  	    $login = $_POST['log'];
     	}
     	}else{
			$msgLoginErreur = 'Ce champ est obligatoire !!!';
   	  	    $password = $_POST['pass'];
     	}
     }

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="asset/css/auth.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="asset/css/page.css?<?php echo time();?>">
</head>
<body style="background-image: url('asset/img/Images/img-bg.jpg');">

    <div class="header">
        <img src="asset/img/Images/logo-QuizzSA.png" alt="logo">
        <h2>Le plaisir de jouer</h2>
    </div>

	<div id="container">
		<div id="entet">
			<h3 id="h3entet" >Login Form</h3>
		</div>

		<div id="fomrContainer" >
			<form action="" method="post">
                <div class="inputConyainer">
                	<img src="asset/img/Images/Icones/ic-login.png" class="iconForm">
					<input type="text" name="log" placeholder="Login" value="<?php echo $login; ?>" class="input">
					<br><label><?php echo $msgLoginErreur ; ?></label>
                </div>
                <div class="inputConyainer">
                	<img src="asset/img/Images/Icones/ic-password.png" class="iconForm">
					<input type="password" name="pass" placeholder="Password" value="<?php echo $password; ?>" class="input">
					<br><label><?php echo $msgPasswordErreur; ?></label>
                </div>

                <div class="inputConyainer inputConyainer2">
                	<input id="sub" type="submit" name="cnx" value="Connexion">
                	<a href="views/nouveaus/inscription.php">S’inscrire pour jouer</a>
                </div>
				
			</form>
			
		</div>


		
	</div>

</body>
</html>