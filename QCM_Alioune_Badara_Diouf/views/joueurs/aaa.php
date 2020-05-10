<?php  
    session_start();
    //session_destroy();
    include('../../src/traitementOrdi.php');
    $pos ='';
    $parti = "no_terminer";
	$buttons = '';
	$nbrRep = '';
	$toure =" ";
    
    if (isset($_POST['disconnec'])){
        unset($_SESSION['user']);
		unset($_SESSION['questions_de_la_partie']);
		if (!isset($_SESSION['user'])){
			header('location:../../index.php');
		}
    } 
	if (isset($_POST['rjouer'])){
        $pos = 0;
        unset($_SESSION['questions_de_la_partie']);
        $_SESSION['questions_de_la_partie'] = getQuestionPourLaPartie();
		$_SESSION['nbrQuestionParParti'] = count( $_SESSION['questions_de_la_partie'] );
		$n = rand(0,1);
		if ($n==0) {
			$_SESSION['main'] = 'moi';
			$toure = $_SESSION['user']['prenom'];
		}else{
			$_SESSION['main'] = 'lui';
			$toure = "Ordinateur";
		}
	}
	$main = $_SESSION['main'];
	
    if (isset($_POST['check']) && !isset($_POST['Suivant']) && !isset($_POST['Termner']) ){
		$main = "moi";
		$toure = $_SESSION['user']['prenom'];
		$pos = intval($_POST['pos']);
		if ( ($pos+1) == count($_SESSION['questions_de_la_partie'])) {
			
			if ($_SESSION['questions_de_la_partie'][$pos]['type']){
				$_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
			}
			 $parti = "terminer";
			 $pos = intval($_POST['pos'])+1;		
		}else{
			$pos = intval($_POST['pos']);
			if ($_SESSION['questions_de_la_partie'][$pos]['type']){
				var_dump($$_SESSION['questions_de_la_partie'][$pos]['type']);
				$_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
			}
			 $pos = intval($_POST['pos'])+1;
		}
	}else if ( isset($_POST['Suivant']) && isset($_POST['check']) && !isset($_POST['Termner'])  ) {
		 $main = "lui";
		 $toure = "Ordinateur";
		 $pos = intval($_POST['pos']);
		 if ($_SESSION['questions_de_la_partie'][$pos]['type']){
			var_dump($$_SESSION['questions_de_la_partie'][$pos]['type']);
            $_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
        }
		 $pos = intval($_POST['pos'])+1;
	}else if(isset($_POST['Termner']) && isset($_POST['check']) ){
        $pos = intval($_POST['pos']);
        if ($_SESSION['questions_de_la_partie'][$pos]['type']){
            $_SESSION['questions_de_la_partie'][$pos]['repJoueur'] = $_POST['check'];
        }
         $parti = "terminer";
         $pos = intval($_POST['pos'])+1;
    }else{
		$pos = 0;
	}

	if ($main == "moi") {
		 if ($pos == count($_SESSION['questions_de_la_partie'])-1) {
			 $buttons =$buttons.' <input type="submit" id="bntSui" value="Termner" name="Termner">';
		  }else if($pos > count($_SESSION['questions_de_la_partie'])-1){
			$buttons =' <input type="submit" id="bntSui" value="Demarer" name="rjouer">';
		 }
		  else{
			 $buttons =$buttons.' <input type="submit" id="bntSui" value="Suivant" name="Suivant">';
		  } 
		}else{
			if($pos > count($_SESSION['questions_de_la_partie'])-1){
				$buttons =' <input type="submit" id="bntSui" value="Demarer" name="rjouer">';
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
        <div id="div">
            <div id="laMain"></div>
            <div id="divGauche">
                <div id="questions">
                <form action="aaa.php" id="form" method="post">
					<input type="hidden"  name="pos" value="<?php echo $pos ?>">
					<input type="hidden"  name="main" id="main" value="<?php echo $main ?>">
					<input type="hidden"  name="nbr"  id="nbr" value="<?php echo count($_SESSION['questions_de_la_partie'][$pos]['bonrep']) ?>">
                    <?php if (!empty($_SESSION['questions_de_la_partie']) && $parti!="terminer"){
                        echo affficheQuestion($_SESSION['questions_de_la_partie'][$pos],$_SESSION['nbrQuestionParParti'],$pos+1,$toure);
                    }else{
                        echo '<div id="partieScor">
                        <h3> Score Tatal : '.calculScore($_SESSION['questions_de_la_partie']).' Pts</h3>
                        </div>' ;
                        echo affficheScore($_SESSION['questions_de_la_partie']);
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

            <div id="divDroite">
                <nav>
                    <ul>
                        <li><a>Top score</a></li>
                        <li><a>Mon meilleur score</a></li>
                    </ul>
                </nav>
                <div id="table">
                    <table>
                        <tr>
                            <td>Alioune Badara Diouf</td>
                            <td ><span class="scoreOrange">1022pts</span> </td>
                        </tr>
                        <tr>
                            <td>Moussa Tine</td>
                            <td ><span class="scoreGreen">1022pts</span> </td>
                        </tr>
                        <tr>
                            <td>Amath Diouf</td>
                            <td ><span class="scoreBleu">1022pts</span> </td>
                        </tr>
                    </table>
                </div>
            </div>
       </div>
        
	</div> 
	
	
	<script>
var myform = document.getElementById('form')
var chk = document.getElementById('form').getElementsByClassName('chk');
var nbr  = parseInt( document.getElementById('nbr').value );
var compteur =0;
var main = document.getElementById('main');
var lamain = document.getElementById('lamain');

if (main.value=="lui") {
	setInterval(coche,3000);
}
 function coche(){
	var index = Math.floor((Math.random() * ((chk.length)-0)) + 0);
	if (!chk[index].hasAttribute('checked')){
		chk[index].setAttribute('checked','checked');
		compteur++;
		if(compteur == nbr) {
			myform.submit();
	    }
	}
 }

if (lamain){
	setInterval(cacheMain,3600);
 function afficheMain(){
	var mn  = lamain.innerHTML ;
	lamain.style.visibility='visible';	
 }
 function cacheMain(){
	var mn  = lamain.innerHTML ;
	lamain.style.visibility='hidden';
 }
 setInterval(afficheMain,4000);
}
</script>
</body>
</html>