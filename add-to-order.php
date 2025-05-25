
<?php include "dbcon.php" ?>


<?php
    if(isset($_POST['addorder']))
        {
        $user_id = $_SESSION['user_id']; // or any method to get user ID
        $payment_method = $_POST['payment_method']; // The payment method selected
        $total_amount = $totalamount; // The total amount from your cart
        
        $insert = $conn->prepare("INSERT INTO orders (user_id,payment_method,total_amount) VALUES (:user_id,:payment_method,:total_amount)");
        $insert->execute([

            ':user_id' => $user_id,
            ':payment_method' => $payment_method,
            ':total_amount' => $total_amount

        ]);

         // Get the last inserted order ID
         $order_id = $conn->lastInsertId();

        foreach ($product as $c) {
            $product_name = $c->product_name;
            $quantity = $c->cart_qty;
            $price = $c->price;
        
            $query = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) 
                      VALUES (:order_id, :product_name, :quantity, :price)");
            $query->execute([

                ':order_id' => $order_id,
                ':product_name' => $product_name,
                ':quantity' => $quantity,
                ':price' => $price

            ]);
            
        }

         // Redirect to checkout.php
         header('Location: paypal.php');
         exit(); // Ensures the script stops executing further
         
        }

        
       
?>

        <?php include "include/header.php" ?>