<?php  
require_once('config.php');
session_start(); 

$welcomeMessage = "";
$messageInfo = "";

if(isset($_SESSION["username"])) {
     $welcomeMessage = '<h3>Välkommen - '.$_SESSION["username"]. '</h3>';  
}


try  
{  
     if(isset($_POST["postmessage"]))  
     {  
          if(empty($_POST["message"]) )  
          {  
               $messageInfo = '<h2><span class="badge badge-warning"> Du måste skriva något innan du kan skapa inlägget </span></h2>';  
          } else { 

                    $message = htmlspecialchars($_POST['message']);
                    $writer = $_SESSION["username"];
                    $timewritten = date('Y-m-d H:i:s');
     
                    $sql = 'INSERT INTO messages (message, writer, timewritten) VALUES(?,?,?)';
                    $stmtinsert = $connect->prepare($sql);
                    $result = $stmtinsert->execute([$message, $writer, $timewritten]);
                    
                    if($result){
                         $messageInfo = '<h2><span class="badge badge-success"> Meddelandet postat </span></h2>Meddelandet postat';
                    } else {
                         $messageInfo = '<h2><span class="badge badge-warning"> Ett problem uppstod när meddelandet skulle skapas </span></h2>';
                    } 
                
          } 

     }  
}  
catch(PDOException $error)  
{  
     $warningMessage = $error->getMessage();  
} 

try {
     $messagesql = 'SELECT message, writer, timewritten FROM messages';
     $stmt  = $connect->prepare($messagesql);
     $stmt->execute();
     $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $error)  
{  
     $messageInfo = $error->getMessage();  
} 

?>

<!DOCTYPE html>  
 <html>  
     <head>  
          <title>Skriv Meddelanden</title>  
          <?php include 'bootstrap.php'; ?>  
     </head>  
     <body>
          <?php 
          if(isset($welcomeMessage)) {  
               echo $welcomeMessage;
          } 
          ?>  
          <br />  
          <div class="container" style="width:80wv;">  
               <h2>Meddelanden</h2><br />
               <table class="table table-striped">
               <thead>
                    <tr>
                         <th>Skrivet av</th>
                         <th>Meddelande</th>
                         <th>Tidpunkt skrivet</th>
                    </tr>
               </thead>
          <?php 
          if(isset($messages))  
               {  
                    foreach ($messages as $row){ 
                         echo "<tr><td>".$row["writer"]."</td><td>".$row["message"]."</td><td>".$row["timewritten"]."</td></tr>";
                    } 
               } 
          ?>
          </table>
          <?php 
          if(isset($messageInfo))  
          {  
               echo $messageInfo;  
          } 
          ?>   
               <form method="post">  
                    <textarea type="text" name="message" class="form-control" rows="5" id="comment"></textarea>
                    <br />  
                    <input type="submit" name="postmessage" class="btn btn-info" value="Skapa inlägg" />  
               </form>
   
               <br /><br /><a href="logout.php">Logga ut</a>
          </div>  
          <br /> 
     </body>  
</html>  
