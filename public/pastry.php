<?php
require_once '../config/db.php';
$pageTitle = 'Pastries';
require_once '../public/header.php';

$sql = "SELECT * FROM products p JOIN categories c ON p.category_id=c.category_id WHERE c.category_name='Pastries'";
$result = $conn->query($sql);?>

<div class="category-title">
    <h2>Pastries</h2>
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

<?php require_once '../public/footer.php'; ?>