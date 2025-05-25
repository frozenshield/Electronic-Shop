<?php include "dbcon.php" ?>
<?php
//delete for cart
if(isset($_POST['delete']))
    {
        $productid = $_POST['product_id'];
        $userid = $_POST['user_id'];

        $delete = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id ");
        $delete->execute([

            ':user_id' => $userid,
            ':product_id' => $productid
        ]);

        header("Location: index.php");
    }

?>

<?php
//delete for wishlist
if(isset($_POST['deletee']))
    {
        $productid = $_POST['product_id'];
        $userid = $_POST['user_id'];

        $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id ");
        $delete->execute([

            ':user_id' => $userid,
            ':product_id' => $productid
        ]);

        header("Location: index.php");
    }

?>