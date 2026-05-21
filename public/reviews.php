<?php
require_once '../config/db.php';
$pageTitle = 'Reviews - Bakers Bakery Reviews';
require_once '../public/header.php';
ob_start();
include 'chatbot.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['customer_id'])) {
        header("Location: ../auth/customer_login.php");
        exit();
    }

    $customerId = (int) $_SESSION['customer_id'];
    $productId = (int) $_POST['product_id'];
    $rating = (int) $_POST['rating'];
    $comment = trim($_POST['comment']);

    $stmt = $conn->prepare("
        INSERT INTO customer_reviews
        (customer_id, product_id, rating, comment, status)
        VALUES (?, ?, ?, ?, 'pending')
    ");

    $stmt->bind_param("iiis", $customerId, $productId, $rating, $comment);
    $stmt->execute();
    $stmt->close();

    header("Location: reviews.php?success=1");
    exit();
}

$sqlReviews = "
    SELECT cr.*, c.full_name, p.product_name
    FROM customer_reviews cr
    JOIN customers c ON cr.customer_id = c.customer_id
    JOIN products p ON cr.product_id = p.product_id
    WHERE cr.status = 'approved'
    ORDER BY cr.review_id DESC
    LIMIT 6
";
$resultReviews = $conn->query($sqlReviews);

$sqlProducts = "SELECT product_id, product_name FROM products ORDER BY product_name";
$resultProducts = $conn->query($sqlProducts);

function displayStars(int $rating): string {
    $stars = "";
    $rating = max(0, min($rating, 5));
    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $rating) ? "⭐" : "⭐";
    }
    return $stars;
}
?>

<div class="content">
    <main class="main">
        <h2>Customer Reviews</h2>
        <p>Read what customers are saying about Bakers Bakery products.</p>

        <section class="section">
            <div class="product-grid">
                <?php while($review = $resultReviews->fetch_assoc()): ?>
                    <article class="review-box">
                        <h3><?php echo htmlspecialchars($review['full_name']); ?></h3>
                        <p><strong>Product:</strong> <?php echo htmlspecialchars($review['product_name']); ?></p>
                        <div class="rating-stars"><?php echo displayStars((int) $review['rating']); ?></div>
                        <p><?php echo htmlspecialchars($review['comment']); ?></p>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>

        <section class="section">
            <h2>Write Your Review</h2>
            <p>Use this form to prepare a customer review.</p>
            <?php if(isset($_GET['success'])): ?>

                <div class="success-message" id="successMessage">
                    Review submitted successfully!
                </div>

                <script>
                    setTimeout(function() {
                        const message = document.getElementById("successMessage");
                        if(message){
                            message.style.opacity = "0";
                            setTimeout(() => {
                                message.style.display = "none";
                            }, 500);
                        }
                    }, 3000);
                </script>

            <?php endif; ?>

            <form class="review-form" method="POST">

                <label>Product</label>
                <select name="product_id" required>
                    <option value="">Select a product</option>
                    <?php while($product = $resultProducts->fetch_assoc()): ?>
                        <option value="<?php echo $product['product_id']; ?>">
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Rating</label>
                <select name="rating" required>
                    <option value="5">5 Stars - Excellent</option>
                    <option value="4">4 Stars - Very Good</option>
                    <option value="3">3 Stars - Good</option>
                    <option value="2">2 Stars - Fair</option>
                    <option value="1">1 Star - Poor</option>
                </select>

                <label>Your Comment</label>
                <textarea name="comment" placeholder="Write your review here" required></textarea>

                <button class="btn submit-btn" type="submit">Submit Review</button>
            </form>
        </section>
    </main>
</div>

<?php include '../public/footer.php'; ?>