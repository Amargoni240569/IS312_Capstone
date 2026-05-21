<?php
include '../config/db.php';
$pageTitle = "Gallery";
include '../public/header.php';
include 'chatbot.php';

/* =========================================
   FETCH PRODUCTS
========================================= */

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

$products = [];

if($result && mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }

}

?>

<div class="gallery-container">

    <h1>Product Gallery</h1>

    <p>
        Browse photos of our cakes, cookies, muffins and pastries.
    </p>

    <div class="gallery-grid">

        <?php if(!empty($products)): ?>

            <?php foreach($products as $product): ?>

                <div class="product-card">

                    <img src="/bakersbakery/<?php echo $product['image_path']; ?>" alt="<?php echo $product['product_name']; ?>">
                    <div class="product-info">

                        <h3>
                            <?php echo $product['product_name']; ?>
                        </h3>

                        <div class="price">
                            K<?php echo number_format($product['price'], 2); ?>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>No products found.</p>

        <?php endif; ?>

    </div>

</div>

<?php include '../public/footer.php'; ?>