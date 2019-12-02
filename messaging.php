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
    $messagesql = 'SELECT message, writer, timewritten FROM messages';
    $stmt  = $connect->prepare($messagesql);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      </head>  
      <body>  
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
                <form method="post">  
                     <textarea type="text" name="message" class="form-control" rows="5" id="comment"></textarea>
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
