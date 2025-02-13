<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chad Wears Website</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/Chad_logo2.png" alt="Logo" class="logo-img">
        </div>
        <nav>
            <a href="homepage.php">Home</a>
            <div class="dropdown">
                <span class="dropbtn">Categories</span>
                <div class="dropdown-content">
                    <?php
                    $query = "SELECT * FROM categories";
                    $categories = mysqli_query($conn, $query);

                    while ($cat = mysqli_fetch_assoc($categories)) {
                        echo '<a href="categories.php?category_id=' . htmlspecialchars($cat['id']) . '">' . htmlspecialchars($cat['name']) . '</a>';
                    }
                    ?>
                </div>
            </div>
            <a href="cart.php">Cart</a>
            <a href="aboutus_contactus.php">Contact Us</a>
            <a href="account.php">Account</a>
        </nav>
    </header>

    <section class="hero">
        <!-- Slideshow container -->
        <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <img src="images/12.jpg">
            </div>

            <div class="mySlides fade">
                <img src="images/2.jpg">
            </div>

            <div class="mySlides fade">
                <img src="images/3.jpg">
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>

        <div class="hero-content">
            <h1>Welcome to Our Store</h1>
            <p>Discover amazing products at unbeatable prices.</p>
            <button id="shop-now-btn">Shop Now</button>
        </div>
    </section>
    
    <h2 class="products-title">Our Most Loved Products</h2>
    <section id="products" class="products">
    <div>
        <div class="product">
            <img src="images/product/tshirt/f9fc49aaf96fb9b232671e3a2b85d2a8.jpg" alt="Product Image">
            <h3>Plain White T-shirt</h3>
            <p>Rs 1200</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/tshirt/tshirt.png" alt="Product Image">
            <h3>Plain White T-shirt</h3>
            <p>Rs 3000</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/pants/black baggy jeans.png" alt="Product Image">
            <h3>Black Jeans</h3>
            <p>Rs 2100</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/pants/blue baggy jeans.png" alt="Product Image">
            <h3>Blue Jeans</h3>
            <p>Rs 2100</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/footware/white nike plain.png" alt="Product Image">
            <h3>Product Title</h3>
            <p>Rs 6000</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/tshirt/022215a0381a58204494dad100fc461c.jpg" alt="Product Image">
            <h3>Brown Puffer Jacket</h3>
            <p>Rs 3500</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/accessories/silver chain bracelet.png" alt="Product Image">
            <h3>Product Title</h3>
            <p>Rs 3000</p>
            <button>Add to Cart</button>
        </div>
        <div class="product">
            <img src="images/product/accessories/vlack ring.png" alt="Product Image">
            <h3>Product Title</h3>
            <p>Rs 500</p>
            <button>Add to Cart</button>
        </div>
    </div>
        
    </section>

    <footer>
        <p>&copy; 2024 E-commerce Website Chad Wears. All rights reserved. | <a href="aboutus_contactus.php">About Us</a> | <a href="#">Privacy Policy</a></p>
    </footer>

    <script>

        document.getElementById('shop-now-btn').addEventListener('click', function() {
            document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
        });

        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }

        // Automatic slide transition
        setInterval(function() {
            showSlides(slideIndex += 1);
        }, 5000); // Change slide every 5 seconds
    </script>
</body>
</html>
