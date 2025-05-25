<?php include "dbcon.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $email = $_POST['email'];
    $review = $_POST['review'];

    // Check if the user has already reviewed this product
    $check = $conn->prepare("SELECT COUNT(*) FROM review WHERE user_id = :user_id AND product_id = :product_id");
    $check->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id,
    ]);
    $existingReview = $check->fetchColumn();

    if ($existingReview > 0) {
        // User has already reviewed this product
        echo "<script>
                alert('You have already reviewed this product.');
                window.location.href = 'product.php?product_id=$product_id#';
              </script>";

    } else {
        // Insert the new review
        $insert = $conn->prepare("INSERT INTO review (user_id, product_id, email, review) VALUES (:user_id, :product_id, :email, :review)");
        $insert->execute([
            ':user_id' => $user_id,
            ':product_id' => $product_id,
            ':email' => $email,
            ':review' => $review,
        ]);

        // Redirect to the same product page to avoid resubmission
        header("Location: product.php?product_id=$product_id#");
        exit;
    }
}
?>