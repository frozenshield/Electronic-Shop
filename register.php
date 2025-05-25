<?php include "dbcon.php" ?>
<?php include "include/ulo.php" ?>
<?php session_start(); ?>

<?php if(isset($_SESSION['username']))
    {
        header("Location: index.php");
    }

    ?>

    

<?php

if(isset($_POST['register']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $insert = $conn->prepare("INSERT INTO account (user,mypass) VALUES (:user,:mypass)");
        $insert->execute([

            ':user' => $username,
            ':mypass' => password_hash($password, PASSWORD_DEFAULT)

        ]);
        $_SESSION['message'] = "Account Created";
        header("Location: index.php");
    }


?>



<div class="container">
  <form method="POST" action="register.php">
    <h1 class="h3 mt-5 fw-normal text-center">Register</h1>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="register" class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <h6 class="mt-3">already Have Account?  <a href="login.php">Sign in</a></h6>
    <h7 class="mt-3"><a href="index.php"> Back to home </a> </h7>
  </form>
</div>


