<?php  
 session_start();  
 require_once('config.php');
 $message = "";
 $accountCreated = "";
 if($_GET){
     $accountCreated = $_GET['accountCreatedMessage'];    
 }
 try  
 {  
      if(isset($_POST["login"]))  
      {  
          if(empty($_POST["username"]) || empty($_POST["password"]))  
          {  
               $message = '<label>All fields are required</label>';  
          }  
          else  
          {  
               $db_password = getDBpassword($connect, $_POST["username"]);
               if (password_verify($_POST['password'], $db_password)) {
                    $_SESSION["username"] = $_POST["username"];
                    header("location:login_success.php");  
               }
               else {
                    echo "Fel lösenord eller användarnamn";
               }
          }  
     }  
}  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  

 function getDBpassword($connect, $username) {
     try {
          $sql = "SELECT password FROM accounts WHERE username='".$username."'";
          $stmt  = $connect->prepare($sql);
          $stmt->execute();
          $result= $stmt->fetch(PDO::FETCH_ASSOC);
          return $result['password'];
     }
     catch(PDOException $error)  
     {  
          $error->getMessage();  
     } 
 }


 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
          <title>Logga in</title>
          <?php include 'bootstrap.php'; ?>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php
               if(isset($accountCreated))  
               {  
                    echo '<h2><span class="badge badge-success">'.$accountCreated.'</span></h2>';  
               }    
               if(isset($message))  
               {  
                    echo '<label class="text-danger">'.$message.'</label>';  
               }  
                ?>  
                <h2>Logga in</h2><br />  
                <form method="post">  
                     <label>Användarnamn</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Lösenord</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Logga in" />  
                </form>  
                <br>
                <br>
                <h5>Inget konto än? Registrera dig här</h5> 
                <a href="registration.php">Skapa konto</a>
           </div>  
           <br /> 
      </body>  
 </html>  