        // fonction qui genere les inpute
        var bntAjout = document.getElementById("bntAjout");
        bntAjout.addEventListener('click',generInpute);
        var conatinerNewchanp = document.getElementById('conatinerNewchanp');
        var nbinp = document.getElementById('nbinp');
        var nbrInput =0 ;
        if (nbinp) {
            nbrInput = parseInt(nbinp.value);
          }

        var choix = document.getElementById('choix');

       function generInpute(e){
           e.preventDefault();
           var newInpute;
           if (choix.value=="chm") {
            newInpute = '<div class="newDiv" id="numero'+nbrInput+'"><input type="text" name="rep[]" onchange="valeurCaseACocher('+nbrInput+')" id="rep'+nbrInput+'"><input type="checkbox" name="chexk[]" id="case'+nbrInput+'"><button type="button" onclick="deletInput('+nbrInput+')"><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt=""></button></div>';
           }else if(choix.value=="chs"){
            newInpute = '<div class="newDiv" id="numero'+nbrInput+'"><input type="text" name="rep[]" onchange="valeurCaseACocher('+nbrInput+')" id="rep'+nbrInput+'"><input type="radio" name="chexk[]" id="case'+nbrInput+'"><button type="button" onclick="deletInput('+nbrInput+')"><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt=""></button></div>';
           }else{
            newInpute = '<div class="newDiv" id="numero'+nbrInput+'"><input type="text" name="rep" id=""><button type="button" onclick="deletInput('+nbrInput+')"><img src="../../asset/img/Images/Icones/ic-supprimer.png" alt=""></button></div>';
           }
           conatinerNewchanp.innerHTML = conatinerNewchanp.innerHTML+newInpute;
           nbrInput++;
       }
      function deletInput(n){
          var inputRemove = document.getElementById('numero'+n);
          inputRemove.remove();
       }

      function resetAll(){
        conatinerNewchanp.innerHTML = '';
        nbrInput = 0;
       }

      function  valeurCaseACocher(n){
          var valeurInpunt = document.getElementById('rep'+n).value;
          document.getElementById('case'+n).value =valeurInpunt;
          //alert(document.getElementById('case'+n).value );
      } 