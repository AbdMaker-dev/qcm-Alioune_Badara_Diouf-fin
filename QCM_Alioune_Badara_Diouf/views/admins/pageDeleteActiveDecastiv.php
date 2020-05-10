<?php 
   include('../../src/fonctions.php');
   if (isset($_GET['action']) && $_GET['action'] =="delet") {
      if ($_GET['id']) {
        $result = deleteUser( ($_GET['id']-1) );
        if ($result == "oki") {
            header('location:pageAdmin.php?result=oki');
        }else{
            header('location:pageAdmin.php?result=not_oki');
        }
      }
   }else if (isset($_GET['action']) && $_GET['action']=="modife") {
    if ($_GET['id']) {
      $result = activeOrDesactiveUser( ($_GET['id']-1) );
      if ($result == "oki") {
         // header('location:pageAdmin.php?result=oki');
      }else{
         // header('location:pageAdmin.php?result=not_oki');
      }
    }
       
   }else{
    header('location:pageAdmin.php');
   }
?>