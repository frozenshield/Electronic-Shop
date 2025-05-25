<?php include "dbcon.php" ?>
<?php


            $user = $_POST['user_id'];
            $productid = $_POST['product_id'];

            $query = $conn->prepare("SELECT qty FROM wishlist WHERE product_id = :product_id AND user_id = :user_id");
            $query->execute([

                ':product_id' => $productid,
                ':user_id' => $user


            ]);

            $cart = $query->fetch(PDO::FETCH_ASSOC);

            if($cart)
            {
            $updated_qty = $cart['qty'] + 1;
            $update = $conn->prepare("UPDATE wishlist SET qty = :qty WHERE user_id = :user_id AND
                                     product_id = :product_id");
            $update->execute([
                ':qty' => $updated_qty,
                ':user_id' => $user,
                ':product_id' => $productid

            ]);

            header("Location: index.php");
            
            }
            else
            {   



            $addcart = $conn->prepare("INSERT INTO wishlist (user_id,product_id,qty) VALUES (:user_id,:product_id,1)");
            $addcart->execute([

                ':user_id' => $user,
                ':product_id' => $productid,

            ]);

            header("Location: index.php");
            }
?>    
