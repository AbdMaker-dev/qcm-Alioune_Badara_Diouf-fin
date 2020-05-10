<?php 

      function getQuestionPourLaPartie(){

        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        $questions_de_la_partie = array();
        for ($i=0; $i < count($cotenuFichier); $i++) { 
          if ($cotenuFichier[$i]["type"] != "cht") {
            $questions_de_la_partie[] = $cotenuFichier[$i];
          }
        }
       return $questions_de_la_partie;
      }

      function getnbr_questions_par_partie(){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        return $cotenuFichier['nbrQuestionParParti'];
      }

      function affficheQuestion($ques,$nbr,$pos,$main){
          $affiche = '';
          $affiche = $affiche.'<div id="partieH">
          <div id="lamain"><h4>'.$main.'</4> <img src="../../asset/img/Images/Icones/fle2.png" alt="" srcset=""></div>
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
      
?>