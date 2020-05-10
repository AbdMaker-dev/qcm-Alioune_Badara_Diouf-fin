<?php 
   
   include('../../src/fonctions.php');

   $questionAafficher = [];

   if (isset($_GET['action']) && $_GET['action'] =="sup") {
        if ($_GET['id']) {
            $result = deleteQuestion( ($_GET['id']-1) );
            if ($result == "oki") {
                header('location:pageAdmin.php?page=1&pos=1&result=oki');
            }else{
                header('location:pageAdmin.php?page=1&pos=1&result=not_oki');
            }
        }
   }else if (isset($_GET['action']) && $_GET['action']=="modif"){
        if ($_GET['id']){
                $questionAafficher = getQuestion(($_GET['id']-1));
        }
   }else{
            header('location:pageAdmin.php?page=1&pos=1');
   }

   if (isset($_POST['cree'])){
        $newQuestion =[];
        if ($_POST['type'] =="cht") {
            $newQuestion = ["question"=>$_POST['question'],"response"=>$_POST['rep'],"nbrPoint"=>$_POST['nbrPoint'],"type"=>$_POST['type']];
        }else{
            $newQuestion = ["question"=>$_POST['question'],"response"=>$_POST['rep'],"nbrPoint"=>$_POST['nbrPoint'],"bonrep"=>$_POST['chexk'],"type"=>$_POST['type']];
        }
        $result = updateQuestion($newQuestion,($_GET['id']-1));
        if ($result=="oki") {
            echo '<script>alert("operation reussite !!!");</script>';
            header('location:pageAdmin.php?page=1&pos=1');
        }else{
            header('location:pageAdmin.php?page=1&pos=1&result=not_oki');
        }
}
    if(isset($_POST['anull'])){
        header('location:pageAdmin.php?page=1&pos=1');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>

    <div id="listjoueurs">
        <div style="width: 100%;color: white;">
             <h3 style="margin-left: 10px;color:#2F4F4F ;" >Modification de question</h3>             
         </div>

      <div style="width: 100%;">
        <form action="" method="post" style="width: 100%; padding-bottom:10px;display: flex;">
            <div style="width:100% ">
            <div class="containerItemform">
                <span>Questions</span>
                <textarea name="question" id="" cols="30" rows="10"><?php if(isset($questionAafficher['question'])){echo $questionAafficher['question'];} ?></textarea>
            </div>

            <div class="containerItemform">
            <span>Nbre de Points</span>
                <input type="number" name="nbrPoint" class="inpt" value="<?=intval($questionAafficher['nbrPoint']);?>">
            </div>

            <div class="containerItemform">
                <span>Type de reponse</span>
                <select name="type" id="choix" onchange="resetAll();">
                    <?php 
                          if ($questionAafficher['type'] == "chs"){
                             echo '<option value="chm">Choix multiple</option>
                             <option value="chs" selected>Choix simple</option>
                             <option value="cht">Choix text</option>';
                          }else if($questionAafficher['type'] == "chm"){
                            echo '<option value="chm" selected>Choix multiple</option>
                            <option value="chs">Choix simple</option>
                            <option value="cht">Choix text</option>';  
                          }else{
                            echo '<option value="chm">Choix multiple</option>
                            <option value="chs">Choix simple</option>
                            <option value="cht" selected>Choix text</option>';  
                          }
                    ?>
            </select><a href="" id="bntAjout"><img src="../../asset/img/Images/Icones/ic-ajout-réponse.png" alt="icon"></a>
            </div>
            <div id="conatinerNewchanp">
                <?php 
                    $question='';
                    $j;
                    if ( $questionAafficher['type'] == "chm" ){
                        for ($j=0; $j < count($questionAafficher['response']); $j++) { 
                            if ( in_array($questionAafficher['response'][$j],$questionAafficher['bonrep'])  ) {
                                $question = $question.'<div id="numero'.$j.'"><input name="rep[]" type="text" value="'.$questionAafficher['response'][$j].'" onchange="valeurCaseACocher('.$j.')" id="rep'.$j.'" ><input type="checkbox" class="check" name="chexk[]" id="case'.$j.'" checked value="'.$questionAafficher['response'][$j].'"><button type="button" onclick="deletInput('.$j.');" ><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt="icon"></button></div>';
                            }else{
                                $question = $question.'<div id="numero'.$j.'"><input name="rep[]" type="text" value="'.$questionAafficher['response'][$j].'" onchange="valeurCaseACocher('.$j.')" id="rep'.$j.'" ><input type="checkbox" class="check" name="chexk[]" id="case'.$j.'" value="'.$questionAafficher['response'][$j].'"><button type="button" onclick="deletInput('.$j.');" ><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt="icon"></button></div>';
                            }
                        } 
                    }else if ($questionAafficher['type'] == "chs"){
                        for ($j=0; $j < count($questionAafficher['response']); $j++) { 
                            if ( in_array($questionAafficher['response'][$j],$questionAafficher['bonrep'])  ) {
                                $question = $question.'<div id="numero'.$j.'"><input name="rep[]" type="text" value="'.$questionAafficher['response'][$j].'" onchange="valeurCaseACocher('.$j.')" id="rep'.$j.'" ><input type="radio" class="radio" id="case'.$j.'" name="chexk[]" checked value="'.$questionAafficher['response'][$j].'"><button type="button" onclick="deletInput('.$j.');" ><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt="icon"></button></div>';
                            }else{
                                $question = $question.'<div id="numero'.$j.'"><input name="rep[]" type="text" value="'.$questionAafficher['response'][$j].'" onchange="valeurCaseACocher('.$j.')" id="rep'.$j.'" ><input type="radio" class="radio" id="case'.$j.'" name="chexk[]" value="'.$questionAafficher['response'][$j].'"><button type="button" onclick="deletInput('.$j.');" ><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt="icon"></button></div>';
                            }
                        }  
                        }else{
                        $question = $question.'<input name="rep" type="text" value="'.$questionAafficher['response'][$j].'">'; 
                    }
                    echo $question;
                ?>
            </div>
            <?php echo '<br><input type="hidden" name="" value="'.$j.'" id="nbinp">'; ?>
             
            <div class="containerItemform">
                 <input class="btnsub" type="submit" name="cree" value="Modifier" id="">
                 <input class="btnsub" type="submit" name="anull" value="Annuler" id="">
            </div> 
        </form>
      </div>
    </div>

        <script src="../../asset/js/inputgenered.js"></script>
</body>
</html>