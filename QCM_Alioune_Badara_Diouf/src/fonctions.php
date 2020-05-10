<?php 

     function insertUser($tabInfoUser,$photo){ 
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        
       $lienPhoto = upload($photo['photo'],$tabInfoUser['log']);

       if ($lienPhoto) {
            $newUser = ["prenom"=>$tabInfoUser['prenom'],"nom"=>$tabInfoUser['nom'],"login"=>$tabInfoUser['log'],"password"=>$tabInfoUser['password'],"img"=>$lienPhoto,"profile"=>'admin'];
            $cotenuFichier['Admine'][] = $newUser;
            $cotenuFichier = json_encode($cotenuFichier);
            file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);
        }else{
            echo "Une erreur c'est produit";
        }
    }

    function insertJoueur($tabInfoUser,$photo){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        
       $lienPhoto = upload($photo['photo'],$tabInfoUser['log']);

       if ($lienPhoto) {
            $newUser = ["prenom"=>$tabInfoUser['prenom'],"nom"=>$tabInfoUser['nom'],"login"=>$tabInfoUser['log'],"password"=>$tabInfoUser['password'],"img"=>$lienPhoto,"profile"=>'joueur',"score"=>0,"etat"=>"activer"];
            $cotenuFichier['Joueur'][] = $newUser;
            $cotenuFichier = json_encode($cotenuFichier);
            file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);
        }else{
            echo "Une erreur c'est produit";
        }
    }


    function upload($photo,$name){
        $chemainEtnomDefinitif ="";
             // ---------------------------------------------verification si y  a un image
      if (!empty($photo['name'])){
        //  ---------------------------------------------recuperation des erreurs 
           $erorr=$photo['error']; 
        // ----------------------------------------------verification si il y'a pas erreur  
        if ($erorr==0){ 
        // ----------------------------------------------recuperation du foto dans un variable temporaire
             $chemainEtnomTmp = $photo['tmp_name'];
        // ----------------------------------------------recuperation de l'extention du foto
             $ext=strrchr($photo['name'],'.');

    
        /* specification du chemin du fichier dans le quel on veut stoke la foto 
            et renomage du foto (changer le nom du foto en mettent le login de l'utilisateur )
        */
            $chemainEtnomDefinitif = "../../asset/img/imgUsers/img_".$name.$ext;
            
            // -------------------------------------------deplacement du foto dans le dossier 
            move_uploaded_file($chemainEtnomTmp,$chemainEtnomDefinitif);

       }
     }
     if ($chemainEtnomDefinitif) {
        return $chemainEtnomDefinitif;
     }
    }

    function deleteUser($id){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
    
        $tallAvantsupe = count($cotenuFichier['Joueur'] );
        unset($cotenuFichier['Joueur'][$id]);
        $tallAprettsupe = count($cotenuFichier['Joueur'] );

        if ($tallAvantsupe > $tallAprettsupe) {
            $cotenuFichierReorganiser = [];
            for ($i=0; $i < ($tallAvantsupe+1) ; $i++) { 
                if ( isset($cotenuFichier['Joueur'][$i]) ) {
                    $cotenuFichierReorganiser[] = $cotenuFichier['Joueur'][$i];
                }
            }
           $cotenuFichier['Joueur'] = $cotenuFichierReorganiser ;
           $cotenuFichier = json_encode($cotenuFichier);
           file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);
           return "oki";
        }else{
            return "notOki";
        }
    }

    function activeOrDesactiveUser($id){

        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        
        var_dump($cotenuFichier['Joueur']);
        die();

        if ($cotenuFichier['Joueur'][$id]['etat'] == "activer") {
            $cotenuFichier['Joueur'][$id]['etat'] = "no_activer";
        }else{
            $cotenuFichier['Joueur'][$id]['etat'] = "activer";
        }
        $cotenuFichier = json_encode($cotenuFichier);
        file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);
        return "oki";
    }

    function deleteQuestion($id){
        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        $tallAvantsupe = count($cotenuFichier );
        unset($cotenuFichier[$id]);
        $tallAprettsupe = count($cotenuFichier );

        if ($tallAvantsupe > $tallAprettsupe) {
            $cotenuFichierReorganiser = [];
            for ($i=0; $i < ($tallAvantsupe+1) ; $i++) { 
                if ( isset($cotenuFichier[$i]) ) {
                    $cotenuFichierReorganiser[] = $cotenuFichier[$i];
                }
            }
           $cotenuFichier = $cotenuFichierReorganiser ;

           $cotenuFichier = json_encode($cotenuFichier);
           file_put_contents('../../asset/json/questions.json',$cotenuFichier);
           return "oki";
        }else{
            return "notOki";
        }

    }

    function addQuestion($question){
        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        $cotenuFichier[]=$question;

        $cotenuFichier = json_encode($cotenuFichier);
        file_put_contents('../../asset/json/questions.json',$cotenuFichier);
        return "oki";
    }

    function getQuestion($id){
        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        
        if(isset($cotenuFichier[$id])){
            return $cotenuFichier[$id];
        }else{
            return false;
        }
    }

    function updateQuestion($question,$id){

        $cotenuFichier = file_get_contents('../../asset/json/questions.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        $cotenuFichier[$id]=$question;

        $cotenuFichier = json_encode($cotenuFichier);
        file_put_contents('../../asset/json/questions.json',$cotenuFichier);
        return "oki";

    }

    function updateQuestionParParti($nbr) {

        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
    
        $cotenuFichier['nbrQuestionParParti'] = $nbr;

        $cotenuFichier = json_encode($cotenuFichier);
        file_put_contents('../../asset/json/jsonUsers.json',$cotenuFichier);

        return getNbreQuestionParParti();
    }

    function getNbreQuestionParParti(){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);

        return $cotenuFichier['nbrQuestionParParti'];
    }

    function triJoueur(){
        $cotenuFichier = file_get_contents('../../asset/json/jsonUsers.json');
        $cotenuFichier = json_decode($cotenuFichier,true);
        $cotenuFichier = $cotenuFichier['Joueur'];
        for ($i=0; $i < count($cotenuFichier)-1; $i++){ 
            for ($j=($i+1); $j < count($cotenuFichier); $j++) { 
                if ($cotenuFichier[$i]['score'] < $cotenuFichier[$j]['score'] ){
                    $tmp = $cotenuFichier[$i] ;
                    $cotenuFichier[$i] = $cotenuFichier[$j];
                    $cotenuFichier[$j] = $tmp;
                }
            }
        }
        return $cotenuFichier;
    }

    function affiche5MeilleurScore(){
        $tabjoueur = triJoueur();
        for ($i=0; $i <= 4 ; $i++) { 
            if (isset($tabjoueur[$i])) {
                $colorBorder = '';
                if ($tabjoueur[$i]['score']< 100 && $tabjoueur[$i]['score']>=50) {
                    $colorBorder= 'scoreBleu';
                }else if ($tabjoueur[$i]['score']>=100) {
                    $colorBorder= 'scoreGreen';
                }else{
                    $colorBorder= 'scoreOrange ';
                }
               echo '
                <tr>
                   <td>'.$tabjoueur[$i]['prenom'] . $tabjoueur[$i]['nom'].'</td>
                   <td ><span class="'.$colorBorder.'">'.$tabjoueur[$i]['score'].' pts</span> </td>
                 </tr>';
              }
        }

    }

?>