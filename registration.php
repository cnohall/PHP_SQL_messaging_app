<?php
require_once('config.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Skapa Konto | PHP</title>
</head>
<body>

<div>
    <?php
        if(isset($_POST['create'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $sql = 'INSERT INTO accounts (firstname, lastname, email, phone, password) VALUES(?,?,?,?,?)';
            $stmtinsert = $connect->prepare($sql);
            $result = $stmtinsert->execute([$firstname, $lastname, $email, $phone, $password]);
            if($result){
                echo "Användarkonto skapat";
                header("location:login.php");  
            } else {
                echo "Ett problem uppstod när användarkontot skulle skapas";
            }
        }
    ?>
</div>

    
<div class="row">
    <div class="col-sm-3">
        <form action="registration.php" method="post">
            <div class="container">
                <h1>Skapa Konto</h1>
                <p>Fyll i dina uppgifter</p>
                <hr class="mb-3">
                <label for="firstname"><b>Förnamn</b></label>
                <input class="form-control"type="text" name="firstname" required>

                <label for="lastname"><b>Efternamn</b></label>
                <input class="form-control" type="text" name="lastname" required>

                <label for="email"><b>E-post</b></label>
                <input class="form-control" type="email" name="email" required>

                <label for="phone"><b>Telefonnr</b></label>
                <input class="form-control" type="text" name="phone" required>

                <label for="password"><b>Lösenord</b></label>
                <input class="form-control" type="password" name="password" required>
                <hr class="mb-3">
                <input class="btn btn-primary"type="submit" name="create" value="Skapa konto">
            </div>
        </div>
    </form>
</div>
<br><br>
<h4>Hade du redan ett konto? Logga in här</h4> 
    <a href="login.php">Logga in</a>

</body>
</html>

