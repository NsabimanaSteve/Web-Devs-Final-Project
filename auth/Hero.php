<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitInspire Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 15px 30px;
            position: fixed;
            width: 100%;
            box-sizing: border-box;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .nav-links li a:hover {
            background-color: #BC1E4A;
            transform: translateY(-2px);
        }

    /* Hero Section */
        .hero {
            text-align: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url("https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 180px 20px 100px;
            position: relative;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.4rem;
            margin: 20px auto;
            max-width: 800px;
            animation: fadeInUp 1s ease 0.2s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .cta-btn {
            display: inline-block;
            background-color: #BC1E4A;
            color: white;
            padding: 15px 35px;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: all 0.3s;
            margin-top: 20px;
            animation: fadeInUp 1s ease 0.4s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .cta-btn:hover {
            background-color: #8A1435;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(188, 30, 74, 0.4);
        }

        

        /* About Us Section */
        .about-us {
            background-color: #fff;
            padding: 80px 20px;
            text-align: center;
        }

        .about-us h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .about-us p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Hero section styling */
        .hero {
        position: relative;
        padding: 4rem 2rem;
        text-align: center;
        }

        .hero p {
        font-size: 1.4rem;
        margin: 20px auto;
        max-width: 800px;
        opacity: 0;
        animation: fadeInUp 1s ease 0.2s forwards;
        }

        /* Define the fadeInUp animation */
        @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }

        /* Make sure the parent container has a defined height */
        .hero {
        min-height: 300px;
        width: 100%;
        }

        /* Ensure content is visible and positioned correctly */
        .hero * {
        position: relative;
        z-index: 1;
        }


        /* Features Section */
        .features {
            padding: 80px 20px;
            background-color: #fff;
            text-align: center;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #BC1E4A;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;

            
        }

/* Updated Classes Section */
        .classes {
            padding: 80px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .classes-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .class-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 350px; /* Fixed height for consistency */
        }

        .class-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .class-card:hover img {
            transform: scale(1.1);
        }

        .class-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
            color: white;
            text-align: center;
        }

        .class-info h3 {
            margin: 0 0 10px 0;
            font-size: 1.5rem;
            color: #BC1E4A;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .class-info p {
            font-size: 1rem;
            margin: 0;
            line-height: 1.4;
        }

        /* Enhanced Trainers Section */
        .trainers {
            padding: 80px 20px;
            background-color: #fff;
            text-align: center;
        }

        .trainers-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .trainer-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .trainer-card:hover {
            transform: translateY(-10px);
        }

        .trainer-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .trainer-info {
            padding: 25px;
            text-align: center;
        }

        .trainer-info h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .trainer-info p {
            color: #666;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-links a {
            color: #BC1E4A;
            font-size: 1.2rem;
            transition: color 0.3s;
            padding: 8px;
        }

        .social-links a:hover {
            color: #8A1435;
        }

/* Membership Section */
        .membership {
            padding: 80px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .membership p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .pricing-link {
            display: inline-block;
            font-size: 1.5rem;
            color: #BC1E4A;
            text-decoration: none;
        }

        .pricing-link:hover {
            text-decoration: underline;
        }

        /* Reviews Section */
        .reviews-section {
            padding: 80px 20px;
            background-color: #fff;
            text-align: center;
        }

        .reviews-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .review-card {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .review-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }

        /* Complete Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 60px 20px 20px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-section {
            padding: 0 20px;
        }

        .footer-section h3 {
            color: #BC1E4A;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-section p {
            margin-bottom: 15px;
            color: #ccc;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #BC1E4A;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
        }

        @media (max-width: 768px) {
            .classes-grid,
            .trainers-container,
            .membership-container,
            .footer-content {
                grid-template-columns: 1fr;
                padding: 10px;
            }

            .plan-card {
                margin: 0 10px;
            }
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 15px;
            }

            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">FitInspire Hub</div>
        <ul class="nav-links">
            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#classes"><i class="fas fa-dumbbell"></i> Classes</a></li>
            <li><a href="#trainers"><i class="fas fa-user"></i> Trainers</a></li>
            <li><a href="#membership"><i class="fas fa-dollar-sign"></i> Membership</a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Transform Your Body, Transform Your Life</h1>
        <p>Join FitInspire Hub and experience state-of-the-art facilities, expert trainers, and a supportive community dedicated to helping you achieve your fitness goals.</p>
        <a href="../auth/signup.php" class="cta-btn">Start Your Journey Now</a>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <h2>About FitInspire Hub</h2>
        <p>At FitInspire Hub, we believe in the power of fitness to transform lives. Whether you're aiming to build muscle, lose weight, or improve overall health, we provide a comprehensive approach to wellness with expert trainers, cutting-edge equipment, and a supportive community that will inspire you to push your limits.</p>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Why Choose Us</h2>
        <div class="features-container">
            <div class="feature-card">
                <i class="fas fa-dumbbell"></i>
                <h3>Modern Equipment</h3>
                <p>State-of-the-art fitness equipment and facilities to help you achieve your goals.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-user-friends"></i>
                <h3>Expert Trainers</h3>
                <p>Certified personal trainers dedicated to your success and transformation.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-clock"></i>
                <h3>24/7 Access</h3>
                <p>Work out on your schedule with our round-the-clock facility access.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-heart"></i>
                <h3>Supportive Community</h3>
                <p>Join a motivated community that inspires and supports your fitness journey.</p>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section id="classes" class="classes">
        <h2 class="section-title">Our Classes</h2>
        <div class="classes-grid">
            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb" alt="Weight Training">
                <div class="class-info">
                    <h3>Weight Training</h3>
                    <p>Build strength and muscle with our comprehensive weight training program.</p>
                </div>
            </div>

            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a" alt="Yoga">
                <div class="class-info">
                    <h3>Yoga</h3>
                    <p>Find balance and flexibility with our expert-led yoga classes.</p>
                </div>
            </div>

            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b" alt="Kickboxing">
                <div class="class-info">
                    <h3>Cardio Kickboxing</h3>
                    <p>Get fit and have fun with our high-energy cardio kickboxing classes.</p>
                </div>
            </div>

            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1573497019418-f4d6e1c5f5e1" alt="Zumba">
                <div class="class-info">
                    <h3>Zumba</h3>
                    <p>Dance your way to fitness with our exciting Zumba classes.</p>
                </div>
            </div>

            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1573497019418-f4d6e1c5f5e1" alt="HIIT">
                <div class="class-info">
                    <h3>HIIT</h3>
                    <p>Dance your way to fitness with our exciting Zumba classes.</p>
                </div>
            </div>

            <div class="class-card">
                <img src="https://images.unsplash.com/photo-1573497019418-f4d6e1c5f5e1" alt="calisthenics">
                <div class="class-info">
                    <h3>Calisthenics</h3>
                    <p>Dance your way to fitness with our exciting Zumba classes.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="trainers">
        <h2 class="section-title">Meet Our Trainers</h2>
        <div class="trainers-container">
            <div class="trainer-card">
                <img src="https://images.unsplash.com/photo-1517841905240-8b11d1d3c5e6" alt="Trainer 1">
                <div class="trainer-info">
                    <h3>John Doe</h3>
                    <p>Expert in strength training and nutrition coaching.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="trainer-card">
                <img src="https://images.unsplash.com/photo-1502767085884-e9b4f6d1b1c6" alt="Trainer 2">
                <div class="trainer-info">
                    <h3>Jane Smith</h3>
                    <p>Specializes in yoga and holistic health.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="trainer-card">
                <img src="https://images.unsplash.com/photo-1502767085884-e9b4f6d1b1c6" alt="Trainer 2">
                <div class="trainer-info">
                    <h3>Jane Smith</h3>
                    <p>Specializes in yoga and holistic health.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Section -->
    <section id="membership" class="membership">
        <h2 class="section-title">Our Membership Plans</h2>
        <p>Choose a plan that works best for you and start your fitness journey with us. <a href="Pricing_newPage.html" class="pricing-link">View Pricing Plans</a></p>
    </section>


    <!-- Reviews Section -->
    <section class="reviews-section">
        <h2 class="section-title">What Our Members Say</h2>
        <div class="reviews-container">
            <div class="review-card">
                <img src="https://images.unsplash.com/photo-1506794778167-4c9b7a2e54c4" alt="Member 1">
                <h3>Emily Johnson</h3>
                <p>"FitInspire Hub has transformed my fitness journey. The trainers are amazing!"</p>
            </div>
            <div class="review-card">
                <img src="https://images.unsplash.com/photo-1518606379828-4e0e8c1f6e5e" alt="Member 2">
                <h3>Michael Brown</h3>
                <p>"I love the community here! Everyone is so supportive and encouraging."</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>FitInspire Hub is dedicated to helping you achieve your fitness goals with state-of-the-art facilities and expert guidance.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#classes">Classes</a></li>
                    <li><a href="#trainers">Trainers</a></li>
                    <li><a href="#membership">Membership</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul>
                    <li><i class="fas fa-phone"></i> (233) 59-176-5158</li>
                    <li><i class="fas fa-envelope"></i> info@fitinspirehub.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> Berekuso Fitness Street, Hill City</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 FitInspire Hub. All rights reserved.</p>
        </div>
    </footer>