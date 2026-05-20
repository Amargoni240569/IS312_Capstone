<?php
include '../config/db.php';
$pageTitle = 'Home';
include '../public/header.php';
include 'chatbot.php';

$sql = "SELECT * FROM products LIMIT 12";
$result = $conn->query($sql);
?>

<section class="hero">
<h2>Freshly Baked Happiness Every Day</h2>

<p>
Discover our delicious collection of cakes, cookies, muffins, and pastries 
made with quality ingredients and baked fresh daily.
</p>
</section>

<div class="about-container">

    <!-- HERO SECTION -->

    <section class="about-hero">

        <div class="about-text">

            <h1>About Bakers Bakery</h1>

            <p>
                At Bakers Bakery, we believe every bite should bring joy.
                Since our beginning, we have been passionate about creating
                fresh, delicious, and beautifully crafted baked goods for
                families, celebrations, and everyday moments.
            </p>

            <p>
                From rich chocolate cakes to crunchy cookies and buttery
                pastries, every product is prepared with premium ingredients,
                creativity, and care.
            </p>

        </div>

        <div class="about-image">

            <img 
                src="../assets/images/bakery.jpg" 
                alt="Bakers Bakery"
            >

        </div>

    </section>

    <!-- VALUES -->

    <section class="about-values">

        <div class="value-card">

            <h2>Fresh Ingredients</h2>

            <p>
                We use high-quality ingredients to ensure every product is
                fresh, soft, and full of flavour.
            </p>

        </div>

        <div class="value-card">

            <h2>Handcrafted Daily</h2>

            <p>
                Our bakers prepare cakes, cookies, muffins, and pastries
                fresh every day with passion and creativity.
            </p>

        </div>

        <div class="value-card">

            <h2>Customer Happiness</h2>

            <p>
                Your happiness is our priority. We aim to make every order
                memorable and satisfying.
            </p>

        </div>

    </section>

    <!-- STORY -->

    <section class="about-story">

        <h2>Our Story</h2>

        <p>
            Bakers Bakery started as a small family bakery with a simple goal:
            to create baked goods that bring people together. Over time, we
            expanded our menu and continued to improve our recipes while
            maintaining the warmth and personal touch of a local bakery.
        </p>

        <p>
            Today, Bakers Bakery proudly serves customers with a wide variety
            of cakes, cookies, muffins, and pastries that are perfect for
            birthdays, family gatherings, office events, and everyday treats.
        </p>

    </section>

    <section class="hero">
    <h2>We provide a wide variety of fresh, delicious baked goods for every occasion.</h2>

</div>

<div class="product-grid">

<?php while($row = $result->fetch_assoc()): ?>

    <div class="product-card">

        <img 
            src="/bakersbakery/<?php echo $row['image_path']; ?>" 
            alt="<?php echo $row['product_name']; ?>"
        >

        <div class="product-info">

            <h3>
                <?php echo $row['product_name']; ?>
            </h3>

            <div class="price">
                K<?php echo number_format($row['price'], 2); ?>
            </div>

            <p class="product-description">
                <?php echo $row['product_description']; ?>
            </p>

            <a href="products.php" class="btn view-btn">
                View Product
            </a>

        </div>

    </div>

<?php endwhile; ?>

</div>

<?php include '../admin/footer.php'; ?>