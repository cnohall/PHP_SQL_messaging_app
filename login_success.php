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

<!DOCTYPE html>  
 <html>  
      <head>  
          <title>Nohall Solutions</title>  
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      </head>  
      <body>  
      </body>  
 </html>  
