<?php 

      function getQuestionPourLaPartie(){

        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        $questions_de_la_partie = array();

        while(count($questions_de_la_partie) < (intval(getnbr_questions_par_partie()))){
            $i = rand(0,count($cotenuFichier)-1);
            if (!in_array($cotenuFichier[$i],$questions_de_la_partie)) {
                $questions_de_la_partie[] = $cotenuFichier[$i];
            }
        }
       return $questions_de_la_partie;
      }

      function getnbr_questions_par_partie(){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        $cotenuFichier_Ques = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier_Ques = json_decode($cotenuFichier_Ques,true);

        if ($cotenuFichier['nbrQuestionParParti'] <= count($cotenuFichier_Ques)) {
          return $cotenuFichier['nbrQuestionParParti'];
        }else{
          return count($cotenuFichier_Ques);
        }
        
      }

      function affficheQuestion($ques,$nbr,$pos){
          $affiche = '';
          $affiche = $affiche.'<div id="partieH">
          <h2>Question '.$pos.'/'.$nbr.'
          <h3>'.$ques['question'].'</h3>
          </div><input class="pts" type="text" disabled value="'.$ques['nbrPoint'].' pst">';
          if ($ques['type']=="chm") {
              for ($i=0; $i <count($ques['response']) ; $i++) { 
                  $rep = $ques['response'][$i];
                  if (in_array($rep,$ques['repJoueur'])){
                    $affiche = $affiche.'<div class="itemQues">
                    <input class="chk" type="checkbox" checked name="check[]" value="'.$rep.'" id="">
                    <label for="">'.$rep.'</label>
                 </div>';
                  }else{
                    $affiche = $affiche.'<div class="itemQues">
                    <input class="chk" type="checkbox" name="check[]" value="'.$rep.'" id="">
                    <label for="">'.$rep.'</label>
                 </div>';
                  }

              }
          }else if ($ques['type']=="chs") {
            for ($i=0; $i <count($ques['response']) ; $i++) { 
                $rep = $ques['response'][$i];
                if (in_array($rep,$ques['repJoueur'])){
                  $affiche = $affiche.'<div class="itemQues">
                  <input class="chk" type="radio" checked name="check[]" value="'.$rep.'" id="">
                  <label for="">'.$rep.'</label>
               </div>';
                }else{
                  $affiche = $affiche.'<div class="itemQues">
                  <input class="chk" type="radio" name="check[]" value="'.$rep.'" id="">
                  <label for="">'.$rep.'</label>
               </div>';
                }
            }
        }else{
             if ($ques['repJoueur']) {
              $affiche = $affiche.'<div class="itemQues">
              <input class="chk" type="text" name="check" id="" value="'.$ques['repJoueur'].'">
             </div>';
             }else{
              $affiche = $affiche.'<div class="itemQues">
              <input class="chk" type="text" name="check" id="">
             </div>';
             }
        }
        return $affiche;
      }

      function affiche($ques,$pos){
        $affiche = '';
        $affiche = $affiche.'<div id="partieH">
        <h3>'.$ques['question'].'</h3>
        </div>';
        if ($ques['type']=="chm") {
            for ($i=0; $i <count($ques['response']) ; $i++) { 
                $rep = $ques['response'][$i];
                if (in_array($rep,$ques['repJoueur']) && in_array($rep,$ques['bonrep'])){
                  $affiche = $affiche.'<div class="itemQues">
                  <input class="chk" type="checkbox" disabled checked name="check[]" value="'.$rep.'" id="">
                  <label for="">'.$rep.'</label><img src="../../asset/img/Images/Icones/vrai.png" alt="logo"/>
               </div>';
                }
                if (in_array($rep,$ques['repJoueur']) && !in_array($rep,$ques['bonrep'])){
                  $affiche = $affiche.'<div class="itemQues">
                  <input class="chk" type="checkbox" disabled checked name="check[]" value="'.$rep.'" id="">
                  <label for="">'.$rep.'</label><img src="../../asset/img/Images/Icones/faux.png" alt="logo">
               </div>';
                }
            }
        }else if ($ques['type']=="chs") {
          for ($i=0; $i <count($ques['response']) ; $i++) { 
              $rep = $ques['response'][$i];
              if (in_array($rep,$ques['repJoueur']) && in_array($rep,$ques['bonrep'])){
                $affiche = $affiche.'<div class="itemQues">
                <input class="chk" type="radio" disabled checked name="check[]" value="'.$rep.'" id="">
                <label for="">'.$rep.'</label><img src="../../asset/img/Images/Icones/vrai.png" alt="logo"/>
             </div>';
              }if (in_array($rep,$ques['repJoueur']) && !in_array($rep,$ques['bonrep'])){
                $affiche = $affiche.'<div class="itemQues">
                <input class="chk" type="radio" disabled checked name="check[]" value="'.$rep.'" id="">
                <label for="">'.$rep.'</label><img src="../../asset/img/Images/Icones/faux.png" alt="logo">
             </div>';
              }
          }
        }else{
           if ($ques['repJoueur']==$ques['response']) {
            $affiche = $affiche.'<div class="itemQues">
            <input class="chk" type="text" name="rep" id="" value="'.$ques['repJoueur'].'"><img src="../../asset/img/Images/Icones/vrai.png" alt="logo"/>
           </div>';
           }else{
            $affiche = $affiche.'<div class="itemQues">
            <input class="chk" type="text" name="rep" id="" value="'.$ques['repJoueur'].'"><img src="../../asset/img/Images/Icones/faux.png" alt="logo">
           </div>';
           }
       }
       return $affiche;
      }

      function affficheScore($tab){
        $score ='';
        for ($i=0; $i <count($tab) ; $i++) { 
          $score = $score.affiche($tab[$i],($i+1));
        }
        return $score;
      }

      function calculScore($tab){
        $scor = 0;
        for ($i=0; $i < count($tab); $i++) { 
          $point  = intval($tab[$i]['nbrPoint']);
          
          if ($tab[$i]['type']!="cht") {
            for ($j=0; $j <count($tab[$i]['repJoueur']) ; $j++) { 
              if (in_array($tab[$i]['repJoueur'][$j],$tab[$i]['bonrep'])) {
                $scor = $scor+$point;
              }
            }
          }else{
            if ($tab[$i]['repJoueur']==$tab[$i]['response']) {
              $scor = $scor+$point;
            }
          }

        }
        return $scor ;
      }
      
      function updateScore($userLog,$newScore){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        
        $cotenuFichier = json_decode($cotenuFichier,true);
        $cotenuFichier2 = $cotenuFichier['Joueur'];

        for ($i=0; $i < count($cotenuFichier2); $i++){ 
           if ($cotenuFichier2[$i]['login']== $userLog) {
             if ($cotenuFichier2[$i]['score']<$newScore) {
                $cotenuFichier2[$i]['score'] = $newScore ; 
             }
           }
        }

        $cotenuFichier['Joueur'] = $cotenuFichier2;
        $cotenuFichier = json_encode($cotenuFichier);
        file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);
      }
?>