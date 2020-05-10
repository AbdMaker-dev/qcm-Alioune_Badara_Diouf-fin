        // validation du formulair qui permet d'ajouter de nouveau question
        var inputs2 = document.getElementById("formQues").getElementsByTagName('input');
        var ques = document.getElementById('ques');
        var creeQues = document.getElementById('creeQues');
        creeQues.addEventListener('click',valideFormQues);
        function valideFormQues(e) {
            
            for (let index = 0; index < inputs2.length; index++){
                if (!inputs2[index].value) {
                    e.preventDefault();
                // erreur.innerHTML = "Tous les champs sont aubligatoire !!!";
                    inputs2[index].style.border ='1px solid red';
                }
            }
            if (ques.value=="") {
                e.preventDefault();
                ques.style.border ='1px solid red';
            }
        }