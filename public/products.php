<?php
require_once '../config/db.php';
$pageTitle = "Products";
require_once '../public/header.php';
include 'chatbot.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<div class="category-title">
    <h2>All Products</h2>
</div>

<div class="product-grid">

<?php while($row = $result->fetch_assoc()): ?>

    <div class="product-card">

        <img 
            src="/bakersbakery/<?php echo $row['image_path']; ?>" 
            alt="<?php echo $row['product_name']; ?>"
        >

        <div class="product-info">

            <h3><?php echo $row['product_name']; ?></h3>

            <p class="price">
                K<?php echo number_format($row['price'], 2); ?>
            </p>

            <p class="product-description">
              <h3><?php echo $row['product_description']; ?></h3>
            </p>

        </div>

    </div>

<?php endwhile; ?>

</div>

<?php require_once '../public/footer.php'; ?>