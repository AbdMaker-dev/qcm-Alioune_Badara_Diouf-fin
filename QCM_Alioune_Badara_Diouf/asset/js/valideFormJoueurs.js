var cree = document.getElementById('cree');
cree.addEventListener('click',valideForm);
var erreur = document.getElementById('erreur');
var inputs = document.getElementById("form").getElementsByTagName('input');
function valideForm(e){
    for (let index = 0; index < inputs.length; index++){
        if (!inputs[index].value) {
            e.preventDefault();
            erreur.innerHTML = "Tous les champs sont aubligatoire !!!";
            inputs[index].style.border ='1px solid red';
        }
    } 
        if (inputs[3].value != inputs[4].value) {
            e.preventDefault();
            erreur.innerHTML ="Les mots de passe ne sont pas conforme !!!";
        }
}
// affissages du foto
var block_img = document.getElementById('block-img');
function affichePhoto(){
    var file = document.getElementById('foto');
    var fread = new FileReader();
    fread.readAsDataURL(file.files[0]);
    fread.onloadend = function(e){
        block_img.innerHTML = '<img class="className" id="idName" src="'+e.target.result+'" alt=""><br>'
        +'<h3 style="margin-left:20%;margin-top: 20px;">Avatar du joueur</h3>';
    }
}
