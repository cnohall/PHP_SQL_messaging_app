<?php  
 session_start();  
 require_once('config.php');
 $message = "";

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
          <title>Nohall Solutions</title>  
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
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