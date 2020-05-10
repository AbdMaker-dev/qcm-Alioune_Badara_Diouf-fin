<?php 
    // fonction qui affiche la liste des joueurs
    function listJoueurs($pos){
        $tabicon = ["fermer.png","ouverte.png"];
        // apel de la fonction triJoueur qui trie les joueur par ordre decroissant
        $listJoueurs  = triJoueur();
        $contenuTable = '';
        $boutonSuivantEtPrecedent='';
        $nbrJoueurParPage = ($pos+1)*2;
        $positionDepar = (($pos-1)+1)*2;
        for ($i = $positionDepar  ; $i < $nbrJoueurParPage && isset($listJoueurs[$i]); $i++){ 
            $logo = "";
            if ($listJoueurs[$i]['etat'] == "activer") {
                $logo =  $tabicon[1];
            }else{
                $logo =  $tabicon[0];
            }
           if ($listJoueurs[$i]['profile']=="joueur") {
            $contenuTable = $contenuTable.'<tr>
            <td>'.$listJoueurs[$i]['nom'].'</td>
            <td>'.$listJoueurs[$i]['prenom'].'</td>
            <td>'.$listJoueurs[$i]['score'].'</td>
            <td><a href="pageDeleteActiveDecastiv.php?action=delet&id='.($i+1).'" onclick="confirmation(this.href);return (false);" > <img id="iconSup" src="../../asset/img/Images/Icones/bin.png" alt="logo"> </a> </td>
            <td> <a href="pageDeleteActiveDecastiv.php?action=modife&id='.($i+1).'" onclick="confirmationActivation(this.href);return (false);" > <img id="iconSup" src="../../asset/img/Images/Icones/'.$logo.'" alt="logo"> </a> </td>
            </tr>';
           }
        }
        // virification si ondoit metre le bouton suivant et precedent
        if ( (count($listJoueurs) - $nbrJoueurParPage) > 0 ){
            $boutonSuivantEtPrecedent='<a href="pageAdmin.php?page=3&pos='.($pos+2).'" class="btn">Suivant</a>';
        }
         if($nbrJoueurParPage > 2 ){
            $boutonSuivantEtPrecedent= $boutonSuivantEtPrecedent.'<a href="pageAdmin.php?page=3&pos='.($pos).'" class="btnprecs">Precednet </a>';
        }
        $tabHtml ='<div id="listjoueurs">
        <table>
        <caption>LISTE DES JOUEURS PAR SCORE</caption>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Score</th>
        </tr>
        '.$contenuTable.'
        </tr>
        </table>'.$boutonSuivantEtPrecedent.'</div>';
        echo $tabHtml;
    }

    // fonction qui affiche la liste des question
    function listQuestions($pos){
        $listQuestions = file_get_contents('../../asset/json/questions.json');
        $listQuestions = json_decode($listQuestions,true);

        $boutonSuivantEtPrecedent='';
        $nbrJoueurParPage = ($pos+1)*2;
        $positionDepar = (($pos-1)+1)*2;

        $lisQuestion = '<div id="listjoueurs">';
        for ($i=$positionDepar; $i < $nbrJoueurParPage && isset($listQuestions[$i]) ; $i++) { 
            $question = ' <p>'.($i+1).$listQuestions[$i]['question'].'</p>';
            if ( $listQuestions[$i]['type'] == "chm" ){
                $question = $question.'<div class="ulhover"> <ul >';
                for ($j=0; $j < count($listQuestions[$i]['response']); $j++) { 
                    if ( in_array($listQuestions[$i]['response'][$j],$listQuestions[$i]['bonrep'])  ) {
                        $question = $question.'<li><input type="checkbox" class="check" name="check" checked>'.$listQuestions[$i]['response'][$j].'</li>';
                    }else{
                        $question = $question.'<li><input type="checkbox" class="check" name="check">'.$listQuestions[$i]['response'][$j].'</li>';
                    }
                } 
                $question = $question.'<div class="diveIconQuestion"> 
                <a href="pageSupEtModifQuestion.php?action=sup&id='.($i+1).'"  onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/trash.png" alt="" srcset=""></a> 
                <a href="pageSupEtModifQuestion.php?action=modif&id='.($i+1).'" onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/pen.png" alt="" srcset=""></a>
                </div> </ul> </div>';               
            }else if ($listQuestions[$i]['type'] == "chs") {
                $question = $question.'<div class="ulhover"><ul>';
                for ($j=0; $j < count($listQuestions[$i]['response']); $j++) { 
                    if ( in_array($listQuestions[$i]['response'][$j],$listQuestions[$i]['bonrep'])  ) {
                        $question = $question.'<li><input type="radio" class="radio" name="radio" checked>'.$listQuestions[$i]['response'][$j].'</li>';
                    }else{
                        $question = $question.'<li><input type="radio" class="radio" name="radio">'.$listQuestions[$i]['response'][$j].'</li>';
                    }
                }  
                $question = $question.'  <div class="diveIconQuestion"> 
                <a href="pageSupEtModifQuestion.php?action=sup&id='.($i+1).'"  onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/trash.png" alt="" srcset=""></a> 
                <a href="pageSupEtModifQuestion.php?action=modif&id='.($i+1).'"  onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/pen.png" alt="" srcset=""></a> </div> </ul></div> ';              
            }else{
                $question = $question.'<div class="ulhover"><ul>';
                $question = $question.'<li><input type="text" class="input" name="radio" value = "'.$listQuestions[$i]['response'].'"></li>';
                $question = $question.'  <div class="diveIconQuestion"> 
                <a href="pageSupEtModifQuestion.php?action=sup&id='.($i+1).'"  onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/trash.png" alt="" srcset=""></a> 
                <a href="pageSupEtModifQuestion.php?action=modif&id='.($i+1).'"  onclick="confirmationActivation(this.href);return (false);"><img src="../../asset/img/Images/Icones/pen.png" alt="" srcset=""></a> </div> </ul> </div>'; 
            }
            $lisQuestion =  $lisQuestion.$question;
        }
                // virification si ondoit metre le bouton suivant et precedent
                if ( (count($listQuestions) - $nbrJoueurParPage) > 0 ){
                    $boutonSuivantEtPrecedent='<a href="pageAdmin.php?page=1&pos='.($pos+2).'" class="btn">Suivant</a>';
                }
                 if($nbrJoueurParPage > 2 ){
                    $boutonSuivantEtPrecedent= $boutonSuivantEtPrecedent.'<a href="pageAdmin.php?page=1&pos='.($pos).'" class="btnprecs">Precednet </a>';
                }
                $lisQuestion = $lisQuestion .$boutonSuivantEtPrecedent;
                $lisQuestion = $lisQuestion.'</div>';
        echo $lisQuestion ;
    }

    // fonction qui affiche le formulaire de creeation de compte admine
    function creeAdmin(){
     $formulaire = '<div id="listjoueurs">
        <div style="width: 100%;color: white;">
             <h3 style="margin-left: 10px;color:#2F4F4F ;" >S’INSCRIRE</h1>
             <h5 style="margin-left: 10px;color:#A9A9A9;">Pour Proposer des quiz</h3>
         </div>
      <div style="width: 100%;">
        <form action="" id="form" method="post" style="width: 100%; padding-bottom:10px;display: flex;" enctype="multipart/form-data">
            <div style="width:70% ">
            <label class="lab" id="erreur"></label><br>
            <div class="containerItemform">
                <label class="lab">Prenom</label><br>
                <input type="text" name="prenom" class="inpt" id="prenom">
            </div>

            <div class="containerItemform">
                <label class="lab">Nom</label><br>
                <input type="text" name="nom" class="inpt">
            </div>

            <div class="containerItemform">
                <label class="lab">Login</label><br>
                <input type="text" name="log" class="inpt">
            </div>

            <div class="containerItemform">
                <label class="lab">Password</label><br>
                <input type="password" name="password" class="inpt">
            </div> 
            
            <div class="containerItemform">
                <label class="lab">Confimer Password</label><br>
                <input type="password" name="password" class="inpt">
            </div>  
            
            <div class="containerItemform">
                 <input class="btn" type="file" name="photo" id="foto"  onchange=" affichePhoto();">
            </div>
            
            <div class="containerItemform">
                 <input class="btnsub" type="submit" name="cree" value="Cree compte" id="cree">
            </div> 
            
         </div>

          <div id="block-img">

          </div>

        </form>
      </div>
        </dive>';
        echo $formulaire;
    }

    // fonction qui affiche le formulaire de creeation de question
    function creeQuestions(){
        $formulaire = '<div id="listjoueurs">
        <div style="width: 100%;color: white;">
             <h3 style="margin-left: 10px;color:#2F4F4F ;" >PARAMETRER VOTRE QUESTION</h1>
         </div>

      <div style="width: 100%;">
        <form action="" id="formQues" method="post" style="width: 100%; padding-bottom:10px;display: flex;">
            <div style="width:100% ">

            <div class="containerItemform">
                <span>Questions</span>
                <textarea name="question" id="ques" cols="30" rows="10"></textarea>
            </div>
            <div class="containerItemform">
            <span>Nbre de Points</span>
                <input type="number" name="nbrPoint" class="inpt">
            </div>
            <div class="containerItemform">
                <span>Type de reponse</span>
                <select name="type" id="choix"  onchange="resetAll();">
                <option value="chm">Choix multiple</option>
                <option value="chs">Choix simple</option>
                <option value="cht">Choix text</option>
            </select> <a href="" id="bntAjout"> <img style="" src="../../asset/img/Images/Icones/ic-ajout-réponse.png" alt="icon"> <a/>
            </div>
            <div id="conatinerNewchanp"></div>
            
            <div class="containerItemform">
                 <input class="btnsub" type="submit" name="creeQuestion" value="Cree compte" id="creeQues">
            </div> 

         </div>
        </form>
      </div>
        </dive>';

        echo $formulaire;
    }

?>