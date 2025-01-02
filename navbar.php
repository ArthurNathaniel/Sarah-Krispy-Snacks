<div class="nav_all">
    <div class="header_banner">
        <div class="greet">
        </div>
        <div class="banner_links">
            <a href="customer_login.php"><i class="fa-solid fa-user"></i> Login</a> | 
            <a href="customer_signup.php"><i class="fa-solid fa-user-plus"></i> Signup</a> |
            <a href="order_history.php"><i class="fa-solid fa-history"></i> Order History</a> |
            <a href="customer_logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>
    <div class="navbar_all">
        <div class="logo"></div>
        <div class="nav_links">
            <a href="index.php"> Home</a>
            <a href="about.php"> About Us</a>
            <!-- Search link will only show on index.php -->
            <a href="javascript:void(0);" id="search-link" style="display: none;">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </a>
            <a href="cart.php" class="cart-link">
                <i class="fa-solid fa-cart-shopping"></i> Cart
                <span class="cart-badge"><?php echo $cartCount; ?></span>
            </a>
            <a href="blog.php"> Blog</a>
            <a href="contact.php"> Contact Us</a>
        </div>
        <div class="cart">
            <a href="cart.php" class="cart-link">
                <i class="fa-solid fa-cart-shopping"></i> Cart
                <span class="cart-badge"><?php echo $cartCount; ?></span>
            </a>
        </div>
        <button id="mobile-button">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="mobile_links" id="mobile-links">
            <a href="index.php"> Home</a>
            <a href="about.php"> About Us</a>
            <a href="javascript:void(0);" id="search-link-mobile" style="display: none;">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </a>
            <a href="cart.php" class="cart-link">
                <i class="fa-solid fa-cart-shopping"></i> Cart
                <span class="cart-badge"><?php echo $cartCount; ?></span>
            </a>
            <a href="blog.php"> Blog</a>
            <a href="contact.php"> Contact Us</a>
        </div>
    </div>

    <!-- Search Input -->
    <div class="search-bar" id="search-bar" style="display: none;">
        <button id="close-search-bar"><i class="fa-solid fa-xmark"></i></button>
        <input type="text" id="search-input" placeholder="Search food...">
    </div>
</div>
<div class="whatsapp_link">
    <a href="https://wa.link/enkdeh">
        <p>Chat Us</p>
        <i class="fa-brands fa-whatsapp"></i>
    </a>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show the Search link only on index.php
        const searchLink = document.getElementById("search-link");
        const searchLinkMobile = document.getElementById("search-link-mobile");
        const currentURL = window.location.href;

        if (currentURL.includes("index.php")) {
            searchLink.style.display = "inline-block";  // Show the search link in the main navbar
            searchLinkMobile.style.display = "inline-block";  // Show the search link in the mobile menu
        } else {
            searchLink.style.display = "none";  // Hide the search link in the main navbar
            searchLinkMobile.style.display = "none";  // Hide the search link in the mobile menu
        }

        // Highlight active link in nav_links
        const navLinks = document.querySelectorAll(".nav_links a");

        navLinks.forEach(link => {
            if (currentURL.includes(link.getAttribute("href"))) {
                link.style.fontWeight = "bold";
                link.style.color = "#CD1827";
            } else {
                link.style.fontWeight = "normal";
                link.style.color = "";
            }
        });

        // Mobile menu toggle
        const button = document.getElementById('mobile-button');
        const mobileLinks = document.getElementById('mobile-links');
        const searchBar = document.getElementById('search-bar');
        const searchLinks = document.querySelectorAll('#search-link, #mobile-search-link');
        const closeSearchBar = document.getElementById('close-search-bar');

        button.addEventListener('click', () => {
            mobileLinks.classList.toggle('active');

            const icon = button.querySelector('i');
            if (mobileLinks.classList.contains('active')) {
                icon.classList.replace('fa-bars-staggered', 'fa-xmark');
            } else {
                icon.classList.replace('fa-xmark', 'fa-bars-staggered');
            }
        });

        // Search bar toggle
        searchLinks.forEach(link => {
            link.addEventListener('click', () => {
                searchBar.style.display = "block";
            });
        });

        // Close search bar using the button
        closeSearchBar.addEventListener('click', () => {
            searchBar.style.display = "none";
        });
    });
</script>
