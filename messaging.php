<?php  

 require_once('config.php');
 session_start(); 
 if(isset($_SESSION["email"])) {
    echo '<h3>Välkommen - '.$_SESSION["email"]. '</h3>';  
 }
 $warningMessage = "";

 try  
 {  
      if(isset($_POST["postmessage"]))  
      {  
           if(empty($_POST["message"]) )  
           {  
                $warningMessage = '<label>Du måste skriva något innan du kan skapa inlägget</label>';  
           } else { 
                $message = $_POST['message'];
                $writer = $_SESSION["email"];
                $timewritten = date('Y-m-d H:i:s');


                $sql = 'INSERT INTO messages (message, writer, timewritten) VALUES(?,?,?)';
                $stmtinsert = $connect->prepare($sql);
                $result = $stmtinsert->execute([$message, $writer, $timewritten]);
                
                if($result){
                    echo "Meddelandet postat";
                    // header("location:messaging.php");  
                } else {
                    echo "Ett problem uppstod när meddelandet skulle skapas";
                } 
            } 

      }  
 }  
 catch(PDOException $error)  
 {  
      $warningMessage = $error->getMessage();  
 } 

 try {
    $messagesql = 'SELECT * FROM messages';
    $stmt  = $connect->prepare($messagesql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $messages = json_encode($result);
 }
 catch(PDOException $error)  
 {  
      $warningMessage = $error->getMessage();  
 } 

 ?>

<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Nohall Solutions</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:80wv;">  
                <h2>Meddelanden</h2><br />  
               <?php 
                     if(isset($messages))  
                {  
                    echo $messages;;  
                } 
                ?>  
                <form method="post">  
                     <input type="text" name="message" class="form-control" />  
                     <br />  
                     <input type="submit" name="postmessage" class="btn btn-info" value="Skapa inlägg" />  
                </form>
                <?php  
                if(isset($warningMessage))  
                {  
                     echo '<label class="text-danger">'.$warningMessage.'</label>';  
                }  
                ?>    
                <br /><br /><a href="logout.php">Logga ut</a>
           </div>  
           <br /> 

      </body>  
 </html>  
