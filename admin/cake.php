<?php
include '../config/db.php';
$pageTitle = 'Cakes';
include "../admin/header.php";

$sql = "SELECT * FROM products p JOIN categories c ON p.category_id=c.category_id WHERE c.category_name='Cakes'";
$result = $conn->query($sql);
?>

<div class="category-title">
    <h2>Cookies</h2>
</div>

<div class="category-section">
    <div class="product-grid">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <img
    src="/bakersbakery/<?php echo trim($row['image_path']); ?>"
    alt="<?php echo htmlspecialchars($row['product_name']); ?>"
    class="product-image">
            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
            <p>K<?php echo number_format($row['price'], 2); ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "../admin/footer.php"; ?>