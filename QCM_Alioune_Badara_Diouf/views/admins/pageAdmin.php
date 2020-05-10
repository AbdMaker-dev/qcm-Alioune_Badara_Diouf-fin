<?php  
    session_start();
    include('../../src/fonctions.php');
    $nbrQUESParti = getNbreQuestionParParti();

    // gestion de le deconnection
    if (isset($_POST['disconnec'])){
        unset($_SESSION['user']);
    } 
    if (!isset($_SESSION['user'])){
        header('location:../../index.php');
    }

    if (isset($_POST['suiv'])){
        if (isset($_POST['pos'])){
        }
    }else{
        $pos=1;
    }
    
    // gestion de la creation de compte admine
    if (isset($_POST['cree'])){
        if (!empty($_FILES['photo']['name'])){
            insertUser($_POST,$_FILES);
        }else{
            echo "Choisir une photo";
        }
    }

    /* gestion d'affissage de message des resutat des differennt action(creation compte,supressionquestion,modificqtion ...) des admine
    if(isset($_GET['result'])){ 
        if($_GET['result']=="oki"){
            echo '<script>alert("operation reussite !!!");</script>';
        }else{
            echo '<script>alert("Echec de l\'opération  !!!");</script>';
        }
    }*/

    // gestion de le creation de question
    if (isset($_POST['creeQuestion'])){
            $newQuestion =[];
            if($_POST['type'] =="cht"){
                $newQuestion = ["question"=>$_POST['question'],"response"=>$_POST['rep'],"nbrPoint"=>$_POST['nbrPoint'],"type"=>$_POST['type'],"repJoueur"=>""];
            }else{
                $newQuestion = ["question"=>$_POST['question'],"response"=>$_POST['rep'],"nbrPoint"=>$_POST['nbrPoint'],"bonrep"=>$_POST['chexk'],"type"=>$_POST['type'],"repJoueur"=>[]];
            }
            $result = addQuestion($newQuestion);
            if($result=="oki"){
                echo '<script>alert("Question ajouter !!!");</script>';
            }
    }

    // gestion de la modification nombre question pose par partie
    if (isset($_POST['b_Ok'])){
       if (isset($_POST['nbrQUESParti'])){
         $nbrQUESParti = updateQuestionParParti($_POST['nbrQUESParti']);
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
    <link rel="stylesheet" type="text/css" href="../../asset/css/components.css?<?php echo time();?>">
</head>
<body style="background-image: url('../../asset/img/Images/img-bg.jpg');">
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
                <li><a onchange="resetAll();" href="pageAdmin.php?page=1&pos=1">Liste Questions <img src="../../asset/img/Images/Icones/ic-liste.png" alt="icon"></a></li>
                <li><a href="pageAdmin.php?page=2">Créer Admin<img src="../../asset/img/Images/Icones/ic-ajout.png" alt="icon"></a></li>
                <li><a href="pageAdmin.php?page=3&pos=1">Liste joueurs<img src="../../asset/img/Images/Icones/ic-liste.png" alt="icon"></a></li>
                <li><a href="pageAdmin.php?page=4">Créer Questions<img src="../../asset/img/Images/Icones/ic-ajout.png" alt="icon"></a></li>
            </div>
        </div>
        <div class="Questionnaire">
            <div>
                  <form action="" method="post">
                        <p>Nombre de Questions/Jeu</p>
                        <input type="text" name="nbrQUESParti" size="3" value="<?php echo $nbrQUESParti; ?>">
                        </input>
                        <button type="submit" name="b_Ok" id="b_Ok">OK</button>
                  </form>
            </div>
            <div class="question">
                <?php 
                    include('components.php');
                    if (isset($_GET['page'])){
                       if ($_GET['page']==1 && isset($_GET['pos'])) {
                        listQuestions(($_GET['pos']-1));
                       }
                       if ($_GET['page']==2) {
                        creeAdmin();
                       }
                       if ($_GET['page']==3 && isset($_GET['pos'])){
                        listJoueurs(($_GET['pos']-1));
                      }
                       if ($_GET['page']==4) {
                        creeQuestions();
                       }else{
                        // page erreurr
                       }
                    }else{
                       listJoueurs(0);
                    }
                ?>    
            </div>
        </div> 
    </div>  
    <script src="../../asset/js/valideFormUser.js"></script>
    <script src="../../asset/js/inputgenered.js"></script>
    <script src="../../asset/js/valideFormeQues.js"></script>
    <script>
        function confirmation(){
            if (confirm('Etes-vous sur de vouloir supprimer ce joueur ?')) {
                document.location.href = href;
            }
        }

        function confirmationActivation(href){
            if (confirm('Etes-vous sur de vouloir effectuer cet action ?')) {
                document.location.href = href;
            }
        }
    </script>
</body>
</html>