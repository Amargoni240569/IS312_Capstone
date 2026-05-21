<?php

$pageTitle = "About Us";

include '../public/header.php';
include 'chatbot.php';

?>

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

</div>

<?php include '../public/footer.php'; ?>