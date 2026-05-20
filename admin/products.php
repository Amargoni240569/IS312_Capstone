<?php
include "../config/db.php";
include "../admin/header.php";

$pageTitle = 'Products';
?>

<?php
if(isset($_POST['create'])){

    $productName = trim($_POST['name']);
    $price = (float) $_POST['price'];
    $categoryName = trim($_POST['category_id']);
    $productDescription = trim($_POST['product_description'] ?? '');
    $stockQuantity = (int) ($_POST['stock_quantity'] ?? 0);

    $categoryStmt = $conn->prepare("SELECT category_id FROM categories WHERE category_name = ?");
    $categoryStmt->bind_param("s", $categoryName);
    $categoryStmt->execute();
    $categoryResult = $categoryStmt->get_result();
    $categoryRow = $categoryResult->fetch_assoc();
    $categoryStmt->close();

    if (!$categoryRow) {
        die("Selected category does not exist.");
    }

    $categoryId = (int) $categoryRow['category_id'];

    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $folder = "../assets/images/" . $categoryName . "/";
    $newImageName = time() . "_" . $imageName;
    move_uploaded_file($tmpName, $folder . $newImageName);

    $dbImagePath = "assets/images/" . $categoryName . "/" . $newImageName;

    $stmt = $conn->prepare("
        INSERT INTO products(category_id, product_name, product_description, price, image_path, stock_quantity)
        VALUES(?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issdsi", $categoryId, $productName, $productDescription, $price, $dbImagePath, $stockQuantity);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = (int) $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
    exit();
}
?>

<div class="container">

    <h1 class="page-title">Manage Products</h1>
    <p class="page-subtitle">
        Add, organize, and manage bakery products.
    </p>

    <div class="category-links">
        <a href="cake.php">Cakes</a>
        <a href="cookie.php">Cookies</a>
        <a href="muffin.php">Muffins</a>
        <a href="pastry.php">Pastries</a>
    </div>

    <div class="product-form-card">

        <h2>Add Product</h2>

        <form method="POST" enctype="multipart/form-data" class="product-form">

            <input type="text" name="name" placeholder="Product Name" required>

            <textarea name="product_description" placeholder="Product Description"></textarea>

            <input type="number" step="0.01" name="price" placeholder="Price" required>

            <input type="number" name="stock_quantity" placeholder="Stock Quantity" min="0" value="0">

            <select name="category_id">
                <option value="1">Cake</option>
                <option value="2">Cookies</option>
                <option value="3">Muffins</option> 
                <option value="4">Pastries  </option>
            </select>

            <input type="file" name="image" required>

            <button type="submit" name="create">
                Create Product
            </button>

        </form>

    </div>

    <div class="products-grid">

        <?php
        $sql = "SELECT p.*, c.category_id FROM products p JOIN categories c ON p.category_id = c.category_id";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()):
        ?>

        <div class="product-card">

            <img
                src="/bakersbakery/<?php echo trim($row['image_path']); ?>"
                alt="<?php echo htmlspecialchars($row['product_name']); ?>"
                class="product-image">

            <div class="product-info">

                <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>

                <p class="price">
                    K<?php echo number_format($row['price'], 2); ?>
                </p>

                <a
                    href="products.php?delete=<?php echo $row['product_id']; ?>"
                    class="delete-btn"
                    onclick="return confirm('Delete this product?')"
                >
                    Delete
                </a>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include "../admin/footer.php"; ?>