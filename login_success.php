<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["email"]))  
 {  

      echo '<h3>Välkommen - '.$_SESSION["email"]. '</h3>';  
      echo '<br /><br /><a href="messaging.php">Läs och skriv meddelanden</a>';  
      echo '<br /><br /><a href="logout.php">Logga ut</a>';  
 }  
 else  
 {  
      header("location:login.php");  
 }  
 ?>  