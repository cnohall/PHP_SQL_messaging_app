<?php

require_once('config.php');


if(isset($_POST['create'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = 'INSERT INTO accounts (firstname, lastname, username, email, phone, password) VALUES(?,?,?,?,?,?)';
    $stmtinsert = $connect->prepare($sql);
    $result = $stmtinsert->execute([$firstname, $lastname, $username, $email, $phone, $hashedPassword]);
    if($result){
        $accountCreatedMessage = "Användarkonto skapat"; 
        header("Location:login.php?accountCreatedMessage=".$accountCreatedMessage);
    } else {
        echo "Ett problem uppstod när användarkontot skulle skapas";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'bootstrap.php'; ?>  
    <title>Skapa Konto | PHP</title>
</head>
<body>
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

                    
                    <label for="username"><b>Användarnamn</b></label>
                    <input class="form-control" type="text" name="username" required>

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

