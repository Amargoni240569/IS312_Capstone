<?php
include '../config/db.php';
$pageTitle = 'Cakes';
include '../public/header.php';
include 'chatbot.php';

$sql = "SELECT * FROM products p JOIN categories c ON p.category_id=c.category_id WHERE c.category_name='Cakes'";
$result = $conn->query($sql);
?>

<div class="category-title">
    <h2>Cakes</h2>
</div>

<div class="category-section">
    <div class="product-grid">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <img src="/bakersbakery/<?php echo $row['image_path']; ?>">
            <h3><?php echo $row['product_name']; ?></h3>
            <p>K<?php echo $row['price']; ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</div>


<?php include '../public/footer.php'; ?>