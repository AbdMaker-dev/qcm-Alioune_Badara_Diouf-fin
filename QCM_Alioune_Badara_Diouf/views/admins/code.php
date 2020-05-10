<?php  
    session_start();
    if (isset($_POST['disconnec'])){
        unset($_SESSION['user']);
    } 
    if (!isset($_SESSION['user'])){
        header('location:../../index.php');
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
</head>

<body>
    <div class="header">
        <img src="../../asset/img/Images/logo-QuizzSA.png" alt="logo">
        <h2>Le plaisir de jouer</h2>
    </div>
    <div class='corps'>
        <div class='entete'>
            <h2>CRÉER ET PARAMÉTRER VOS QUIZZ </h2>
            <form action="" method="post"><input type="submit" id='discon' name="disconnec" value="Déconnexion"></form>
        </div>

        <div class="section_menu_profil">
            <div class="profil">
                <div class="photo">
                    <?php $tof = $_SESSION['user']['img']; ?>
                    <img id="image_profil" src="<?php echo $tof ?>" alt="image_profil">
                </div>
                <div class="description">
                    <em id="nom"><?php echo $_SESSION['user']['prenom'];?></em>
                    <em id="prenom"> <?php echo $_SESSION['user']['nom'];?></em>
                </div>
            </div>
            <div class="menu">
                <li>Liste Questions <img src="../../asset/img/Images/Icones/ic-liste.png" alt="icon"></li>
                <li>Créer Admin<img src="../../asset/img/Images/Icones/ic-ajout.png" alt="icon"></li>
                <li>Liste joueurs<img src="../../asset/img/Images/Icones/ic-liste.png" alt="icon"></li>
                <li>Créer Questions<img src="../../asset/img/Images/Icones/ic-ajout.png" alt="icon"></li>
            </div>
        </div>
        <div class="Questionnaire">
            <p>Nombre de Questions/Jeu</p>
            <input type="text" size="3">
            </input>
            <button id="b_Ok">OK</button>

            
            <div class="question">
                <p>1.Les langages web</p>
                <ul>
                    <li><em> Html</em></li>
                    <li><em>R</em></li>
                    <li><em>Java</em></li>
                </ul>
                <p>2. D'où vient le corona</p>
                <ul>
                    <li> <em>Chine</em></li>
                    <li><em>Italie</em></li>
                </ul>
            </div>
            <div class="footer">
               <form action="" method="post"><input type="submit" name="" value="Suivant"></form>
            </div>

        </div>  
        
    </div>    
</body>
</html>




<p>1.Les langages web</p>
        <ul>
            <li><input type="checkbox" class="check" name="check" value="" id=""> Html</li>
            <li><input type="checkbox" class="check" name="check" value="" id=""> R</li>
            <li><input type="checkbox" class="check" name="check" value="" id=""> Jva</li>
        </ul>
        <p>2. D\'où vient le corona</p>
        <ul>
        <li><input type="radio" class="radio" name="radio" value="" id=""> Html</li>
        <li><input type="radio" class="radio" name="radio" value="" id=""> R</li>
        </ul>
        <p>3. Quel terme definit la langage qui s\'adopte sur Adroid et sur Ios</p>
        <ul>
        <li><input type="text" class="input" name="input" value="" id=""> Html</li>
        </ul>
        <a href="" class="btn">Suivant</a>