<?php

$host = "localhost";
$dbname = "rlg-store";
$username = "root";
$pass = "";

$conn = new PDO ("mysql:host=$host;dbname=$dbname",$username,$pass);

if($conn == true)
    {
        echo "<script>alert('DB CONNECTED SUCCESFULLY');
                windows.location.href='index.php';
                </script>";
        
    }

else
    {
        echo "<script>alert('database not successful');
              windows.location.href='index.php';
              </script>";
    }

?>    

<!--insert -->

<?php

if(isset($_POST))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $insert = $conn->prepare("INSERT INTO user (username,email,pass) VALUES (:username,:email,:pass)");  
        $insert->execute([

            ':username' => $usernanme,
            ':email' => $email,
            ':pass' => password_hash($pass,PASSWORD_DEFAULT);

        ]);

        echo "<script>alert('Data Inserted');
              windows.location.href='index.php';
              </script>;"

    }

?>


<!--delete-->


<?php 
if(isset($_POST['delete']))
    {
        $username = $_POST['username'];

        $delete = $conn->prepare("DELETE FROM users where username = :username");
        $delete->execute([

            ':username' => $username 

        ])
    }

?>


<!--update-->

<?php 

if(isset($_POST['update']))
    {
        $id = $_POST['id'];    
        $username = $_POST['username'];
        $email = $_POST['email'];

        $update = $conn->prepare("UPDATE users SET username = :username, email = :email WHERE id = '$id' ");
        $update->execute([
            
            ':username' => $username,
            ':email' => $email,

        ])
            
    }

?>

<!-- password verify -->

<?php

if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $login = $conn->prepare("SELECT * FROM users WHERE username = '$username' ");
        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0)
            {
                if(password_verify($pass,$data['password']))
                    {
                        $_SESSION['username'] = $data['username'];
                        echo "<script>alert('Login Succefully');
                               windows.location.href='index.php;
                               </script>;"
                    }
                else
                    {
                        echo "wrong password";
                    }
            }

    }