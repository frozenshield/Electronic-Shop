<?php include "dbcon.php" ?>
<?php
 //for index.php add to cart
    if(isset($_POST['addcart']))
        {
            $user = $_POST['user_id'];
            $productid = $_POST['product_id'];

            $query = $conn->prepare("SELECT cart_qty FROM cart WHERE product_id = :product_id AND user_id = :user_id");
            $query->execute([

                ':product_id' => $productid,
                ':user_id' => $user


            ]);

            $cart = $query->fetch(PDO::FETCH_ASSOC);

            if($cart)
            {
            $updated_qty = $cart['cart_qty'] + 1;
            $update = $conn->prepare("UPDATE cart SET cart_qty = :cart_qty WHERE user_id = :user_id AND
                                     product_id = :product_id");
            $update->execute([
                ':cart_qty' => $updated_qty,
                ':user_id' => $user,
                ':product_id' => $productid

            ]);
            
            
            header("Location: index.php");
            
            }
            else
            {   



            $addcart = $conn->prepare("INSERT INTO cart (user_id,product_id,cart_qty) VALUES (:user_id,:product_id,1)");
            $addcart->execute([

                ':user_id' => $user,
                ':product_id' => $productid,

            ]);
            header("Location: index.php");
            }
        }
?>   


<?php
 //from wishlist to add to cart
    if(isset($_POST['wishtocart']))
        {
            $user = $_POST['user_id'];
            $productid = $_POST['product_id'];
            $wishqty = $_POST['qty'];

            $query = $conn->prepare("SELECT cart_qty FROM cart WHERE product_id = :product_id AND user_id = :user_id");
            $query->execute([

                ':product_id' => $productid,
                ':user_id' => $user


            ]);

            $cart = $query->fetch(PDO::FETCH_ASSOC);

            if($cart)
            {
            $updated_qty = $cart['cart_qty'] + $wishqty;
            $update = $conn->prepare("UPDATE cart SET cart_qty = :cart_qty WHERE user_id = :user_id AND
                                     product_id = :product_id");
            $update->execute([
                ':cart_qty' => $updated_qty,
                ':user_id' => $user,
                ':product_id' => $productid

            ]);
            
            $del = $conn->prepare("DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id ");
            $del->execute([

                ':user_id' =>$user,
                ':product_id' => $productid
            ]);
            
            header("Location: index.php");
            
            }
            else
            {   



            $addcart = $conn->prepare("INSERT INTO cart (user_id,product_id,cart_qty) VALUES (:user_id,:product_id,:cart_qty)");
            $addcart->execute([

                ':cart_qty' => $wishqty,
                ':user_id' => $user,
                ':product_id' => $productid,

            ]);
            $del = $conn->prepare("DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id ");
            $del->execute([

                ':user_id' =>$user,
                ':product_id' => $productid

            ]);

            header("Location: index.php");
            }
        }
?>









