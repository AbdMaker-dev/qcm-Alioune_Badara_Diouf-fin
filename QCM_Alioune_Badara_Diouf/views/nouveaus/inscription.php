<?php  

    include_once("../../src/fonctions.php");
        // gestion de la creation de compte admine
        if (isset($_POST['cree'])){
            if (!empty($_FILES['photo']['name'])){
                insertJoueur($_POST,$_FILES);
                header('location:../../index.php');
            }else{
                echo "Choisir une photo";
            }
        }
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../../asset/css/page.css?<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="../../asset/css/joueur.css?<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="../../asset/css/auth.css?<?php echo time();?>">
    <link rel="stylesheet"  href="../../asset/css/css1024.css?<?php echo time();?>" type="text/css" />
    <style>
</style>
</head>

<body style="background-image: url('../../asset/img/Images/img-bg.jpg');">
    <div class="header">
        <img src="../../asset/img/Images/logo-QuizzSA.png" alt="logo">
        <h2>Le plaisir de jouer</h2>
    </div>
    <div class='corps crp'>
        <div class='entete'>
        <div id="div">

        <form style="width: 100%;margin-left: 10px; display: flex;" id="form" action="" method="post" enctype="multipart/form-data">
               <samp id="erreur"></samp>
                <div style="width:70% ">
                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">Prenom</label><br>
					<input type="text" name="prenom" style="padding-left: 10px;width: 80%; margin-top: 10px;height: 40px;background-color:#F5F5F5">
                </div>
                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">Nom</label><br>
					<input type="text" name="nom" style="padding-left: 10px;width: 80%; margin-top: 10px;height: 40px;background-color:#F5F5F5">
                </div>

                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">Login</label><br>
					<input type="text" name="login" style="padding-left: 10px;width: 80%; margin-top: 10px;height: 40px;background-color:#F5F5F5">
                </div>

                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">Password</label><br>
					<input type="text" name="password" style="padding-left: 10px;width: 80%; margin-top: 10px;height: 40px;background-color:#F5F5F5">
                </div>

                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">Confirmer Password</label><br>
                	
					<input type="text" name="log" style="padding-left: 10px;width: 80%;margin-top: 10px;height: 40px;background-color:#F5F5F5">
                </div>  
                <div style="width: 100%;  margin-top: 30px;">
                	<label style="color:#A9A9A9;">choisier une photo</label><br>
					<input type="file" name="photo">
                </div>                                                                       	
                <div style="width: 70%;margin-top: 30px;margin-left:3%;display: flex;">
                	<input style="width: 20%;height: 50px;background-color:#00BFFF; color: white;" type="submit" id="cree" name="cree" value="Connexion">
                </div>
             </div>
              <div id="block-img">
              	  <img  src="../../asset/img/Images/bg-interface-admin.jpg"><br>
              	  <h3 style="margin-left:20%;margin-top: 20px;">Avatar du joueu</h3>
              </div>
			</form>

       </div>
    </div>   
    <script src="../../asset/js/valideFormJoueurs.js"></script>
</body>
</html>