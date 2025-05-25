<?php include "dbcon.php" ?>

<?php

if(isset($_POST['addbilling']))
    {
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
        $phone = $_POST['phone'];


        $insert = $conn->prepare("INSERT INTO billing (user_id,fname,lname,address,zipcode,phone) VALUES (:user_id,:fname,:lname,:address,:zipcode,:phone) ");
        $insert->execute([

            ':user_id' => $user_id,
            ':fname' => $fname,
            ':lname' => $lname,
            ':address' => $address,
            ':zipcode' => $zipcode,
            ':phone' => $phone

        ]);

        // Redirect to checkout.php
        header('Location: checkout.php');
        exit(); // Ensures the script stops executing further

    }   

    if(isset($_POST['editbilling']))
        {
            $user_id = $_POST['user_id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $zipcode = $_POST['zipcode'];
            $phone = $_POST['phone'];

            $edit = $conn->prepare("UPDATE billing SET fname = :fname, lname = :lname, address = :address, zipcode = :zip, phone = :phone 
            WHERE user_id = :user_id ");
            $edit->execute([
                ':user_id' => $user_id,
                ':fname' => $fname,
                ':lname' => $lname,
                ':address' => $address,
                ':zip' => $zipcode,
                ':phone' => $phone

            ]);
            // Redirect to checkout.php
            header('Location: checkout.php');
            exit(); // Ensures the script stops executing further
        }
    