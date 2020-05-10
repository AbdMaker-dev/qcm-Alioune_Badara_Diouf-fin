<?php  
    session_start();
    //session_destroy();
    include('../../src/traitement.php');
    include('../../src/fonctions.php');
    $pos ='';
    $parti = "no_terminer";
    $buttons = '';
    
    if (isset($_POST['disconnec'])){
        unset($_SESSION['user']);
        unset($_SESSION['questions_de_la_partie']);
    } 
    if (!isset($_SESSION['user'])){
        header('location:../../index.php');
    }

    
    if (isset($_POST['Suivant']) && isset($_POST['check'])){
        $pos = intval($_POST['pos']);
        if ($_SESSION['questions_de_la_partie'][$pos]['type']){
            $_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
        }
         $pos = intval($_POST['pos'])+1;
    }else if (isset($_POST['Precedent'])){
        $pos = intval($_POST['pos'])-1;
    }else if(isset($_POST['Termner']) && isset($_POST['check']) ){
        $pos = intval($_POST['pos']);
        if ($_SESSION['questions_de_la_partie'][$pos]['type']){
            $_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
        }
         $parti = "terminer";
         $pos = intval($_POST['pos'])+1;
    }else if (isset($_POST['rjouer'])) {
        $pos = 0;
        unset($_SESSION['questions_de_la_partie']);
        $_SESSION['questions_de_la_partie'] = getQuestionPourLaPartie();
        $_SESSION['nbrQuestionParParti'] =  getnbr_questions_par_partie();
    }
    else{
        $pos = 0;
        //unset($_SESSION['questions_de_la_partie']);
    }

    if ($pos>0) {
       $buttons =$buttons.' <input type="submit" id="bntpre" value="Precedent" name="Precedent">';
    }
    if ($pos == count($_SESSION['questions_de_la_partie'])-1) {
        $buttons =$buttons.' <input type="submit" id="bntSui" value="Termner" name="Termner">';
     }else if($pos > count($_SESSION['questions_de_la_partie'])-1){
        $buttons =' <input type="submit" id="bntSui" value="Demarer" name="rjouer">';
     }
     else{
        $buttons =$buttons.' <input type="submit" id="bntSui" value="Suivant" name="Suivant">';
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
    <style>
        /* Style tab links */
</style>
</head>

<body style="background-image: url('../../asset/img/Images/img-bg.jpg');">
    <div class="header">
        <img src="../../asset/img/Images/logo-QuizzSA.png" alt="logo">
        <h2>Le plaisir de jouer</h2>
    </div>
    <div class='corps crp'>
        <div class='entete'>
        <div class="photoj">
                    <?php $tof = $_SESSION['user']['img']; ?>
                    <img id="image_profil" src="<?php echo $tof ?>" alt="image_profil">
                    <div class="descriptionj">
                        <em id="nom"><?php echo $_SESSION['user']['prenom'];?></em>
                        <em id="prenom"> <?php echo $_SESSION['user']['nom'];?></em>
                    </div>
        </div>
            <h2>CRÉER ET PARAMÉTRER VOS QUIZZ </h2>
            <form action="" method="post"><input type="submit" id='discon' name="disconnec" value="Déconnexion"></form>
        </div>
        <a type="button"  id="bntSui" style="text-decoration: none; text-align:center;margin:10px;padding-top:17px;" href="aaa.php">Partie avec l'ordit</a>
        <div id="div">
            <div id="divGauche">
                <div id="questions">
                <form action="" method="post">
                    <input type="hidden"  name="pos" value="<?php echo $pos ?>">
                    <?php if (!empty($_SESSION['questions_de_la_partie']) && $parti!="terminer"){
                        echo affficheQuestion($_SESSION['questions_de_la_partie'][$pos],$_SESSION['nbrQuestionParParti'],$pos);
                    }else{
                        echo '<div id="partieScor">
                        <h3> Score Tatal : '.calculScore($_SESSION['questions_de_la_partie']).' Pts</h3>
                        </div>' ;
                        echo affficheScore($_SESSION['questions_de_la_partie']);
                        updateScore($_SESSION['user']['login'],calculScore($_SESSION['questions_de_la_partie']));
                    }
                    ?>
                    <div class="itemQues">
                        <?php 
                            echo $buttons;
                        ?>
                    </div>
                </form>

                </div>
            </div>
            <div id="divDroite" style="background-color: white;" >
                <nav style="width: 100%;">
                    <ul style="width: 100%; display:flex">
                       <button class="tablink" onclick="openPage('News', this, 'white')" id="defaultOpen">Top 5 meilleurs score</button>
                       <button class="tablink" onclick="openPage('Home', this, 'white')">Mon score</button>
                       
                    </ul>
                </nav>
                <div id="News" class="tabcontent">
                <div id="table">
                    <table>
                         <?php  affiche5MeilleurScore() ?>                    
                    </table>
                </div>
                </div>
                <div id="Home" class="tabcontent">
                    <div id="table">
                        <table>
                           <tr><span class="scoreOrange">Votre score <?php echo $_SESSION['user']['score'];?>  pts</span></tr>                    
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>   
    <script src="../../asset/js/onglet.js"></script>
</body>
</html>