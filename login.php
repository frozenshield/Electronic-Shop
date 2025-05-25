<?php include "dbcon.php" ?>
<?php include "include/ulo.php" ?>
<?php session_start(); ?>

<?php if(isset($_SESSION['username']))
    {
        header("Location: index.php");
    }

    ?>

<?php

if(isset($_POST['login']))
    {
        if($_POST['username'] == '' OR $_POST['password'] == '')
            {
                echo "some input are empty";
            }
        else
            {
                $username = $_POST['username'];
                $pass = $_POST['password'];

                $login = $conn->query("SELECT * FROM account WHERE user = '$username' ");
                $login->execute();
                $data = $login->fetch(PDO::FETCH_ASSOC);
                
                if($login->rowCount() > 0)
                    {
                        if(password_verify($pass, $data['mypass']))
                        {
                            $_SESSION['username'] = $data['user'];
                            $_SESSION['user_id'] = $data['user_id'];
                            $_SESSION['email'] = $data['email'];
                            
                            header("Location: index.php");
                        }
                        else
                        {
                            echo "wrong password";
                        }
                    }
                else
                    {
                        echo "Invalid username/password";        
                    }
            
            }
    }




?>


<div class="container">
  <form method="POST" action="login.php">
    <h1 class="h3 mt-5 fw-normal text-center">Please login in</h1>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="login" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
    <h7 class="mt-3"><a href="index.php"> Back to home </a> </h7>
  </form>
</div>


