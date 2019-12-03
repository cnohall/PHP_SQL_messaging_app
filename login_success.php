<?php  
 session_start();  
 $message = "";
 if(isset($_SESSION["username"]))  
 {  
     $message = '<h3>Välkommen - '.$_SESSION["username"]. '</h3> 
     <br /><br /><a href="messaging.php">Läs och skriv meddelanden</a> 
     <br /><br /><a href="logout.php">Logga ut</a>';  
 }  
 else  
 {  
      header("location:login.php");  
 }  
 ?>  

<!DOCTYPE html>  
 <html>  
     <head>  
          <title>Inloggad</title>
          <?php include 'bootstrap.php'; ?>    
     </head>  
     <body>
     <?php  
     if(isset($message)) {  
          echo $message;
     }   
     ?> 
     </body>  

 </html>  
