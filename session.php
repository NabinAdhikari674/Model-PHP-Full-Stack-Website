<?php
   include('database.php');
   session_start();
   $user_check = $_SESSION['loggedUser'];
   $ses_sql = mysqli_query($conn,"SELECT UserName from userDetails where UserName = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['UserName'];

   if(!isset($_SESSION['loggedUser'])){
      header("location:login.php");
      die();
   }
   else {
     header("location:index.php");
     die();
   }
?>
