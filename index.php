<?php
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicare Hospital</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- Navbar -->

    <header>
        <nav class="navbar">

            <div class="logo">
                <i class="fa-solid fa-heart-pulse"></i>
                Medicare
            </div>

            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#department">Departments</a></li>
                <li><a href="#doctor">Doctors</a></li>
                <li><a href="#appointment">Appointment</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            <div class="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div>

        </nav>
    </header>

    <!-- Hero Section -->

    <section class="hero" id="home">

        <div class="overlay"></div>

        <div class="hero-content">

            <span>24/7 Emergency Medical Services</span>

            <h1>
                Your Health <br>
                Our Highest Priority
            </h1>

            <p>
                Trusted by thousands of patients with modern healthcare,
                expert doctors and advanced medical technology.
            </p>

            <div class="hero-buttons">

                <a href="#appointment" class="btn-primary">
                    Book Appointment
                </a>

                <a href="#contact" class="btn-secondary">
                    Emergency Call
                </a>

            </div>

        </div>

    </section>

    <!-- Emergency Banner -->

    <section class="emergency-banner">

        <div class="banner-content">

            <i class="fa-solid fa-truck-medical"></i>

            <div>
                <h3>24/7 Emergency Services</h3>
                <p>Call Now : +91 9876543210</p>
            </div>

        </div>

    </section>

    <!-- About Section -->

<section class="about" id="about">

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=1000" alt="">
    </div>

    <div class="about-content">

        <span>ABOUT US</span>

        <h2>
            Providing Quality Healthcare
            For Every Patient
        </h2>

        <p>
            Our hospital is equipped with modern medical technology,
            experienced doctors and compassionate staff dedicated to
            providing exceptional healthcare services.
        </p>

        <div class="about-features">

            <div>
                <i class="fa-solid fa-circle-check"></i>
                Expert Doctors
            </div>

            <div>
                <i class="fa-solid fa-circle-check"></i>
                Emergency Support
            </div>

            <div>
                <i class="fa-solid fa-circle-check"></i>
                Modern Equipment
            </div>

            <div>
                <i class="fa-solid fa-circle-check"></i>
                Affordable Treatment
            </div>

        </div>

    </div>

</section>

<!-- Why Choose Us -->

<section class="why-us">

    <h2>Why Choose Our Hospital</h2>

    <div class="why-container">

        <div class="why-card">
            <i class="fa-solid fa-user-doctor"></i>
            <h3>Qualified Doctors</h3>
            <p>Experienced specialists providing world-class treatment.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-bed-pulse"></i>
            <h3>Advanced Facilities</h3>
            <p>Modern operation theatres and advanced equipment.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-heart-pulse"></i>
            <h3>24/7 Care</h3>
            <p>Round-the-clock emergency support and monitoring.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-shield-heart"></i>
            <h3>Patient Safety</h3>
            <p>Your health and safety remain our highest priority.</p>
        </div>

    </div>

</section>

<!-- Departments -->

<section class="departments" id="department">

    <h2>Our Departments</h2>

    <div class="department-container">

        <div class="department-card" id="Cardiology">
            <i class="fa-solid fa-heart"></i>
            <h3>Cardiology</h3>
        </div>

        <div class="department-card" id="Neurology">
            <i class="fa-solid fa-brain"></i>
            <h3>Neurology</h3>
        </div>

        <div class="department-card" id="Orthopedics">
            <i class="fa-solid fa-bone"></i>
            <h3>Orthopedics</h3>
        </div>

        <div class="department-card">
            <i class="fa-solid fa-baby"></i>
            <h3>Pediatrics</h3>
        </div>

        <div class="department-card">
            <i class="fa-solid fa-eye"></i>
            <h3>Ophthalmology</h3>
        </div>

        <div class="department-card">
            <i class="fa-solid fa-stethoscope"></i>
            <h3>General Medicine</h3>
        </div>

    </div>

</section>

<!-- Statistics -->

<section class="stats">

    <div class="stat-box">
        <h2 class="counter" data-target="250">0</h2>
        <p>Doctors</p>
    </div>

    <div class="stat-box">
        <h2 class="counter" data-target="50000">0</h2>
        <p>Patients Treated</p>
    </div>

    <div class="stat-box">
        <h2 class="counter" data-target="35">0</h2>
        <p>Departments</p>
    </div>

    <div class="stat-box">
        <h2 class="counter" data-target="20">0</h2>
        <p>Years Experience</p>
    </div>

</section>

<!-- Doctors Section -->

<section class="doctors" id="doctor">

    <div class="section-title">
        <span>OUR SPECIALISTS</span>
        <h2>Meet Our Expert Doctors</h2>
    </div>

    <div class="doctor-container">

        <div class="doctor-card">
            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=800" alt="">
            <div class="doctor-info">
                <h3>Dr. Michael Smith</h3>
                <p>Cardiologist</p>
            </div>
        </div>

        <div class="doctor-card">
            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800" alt="">
            <div class="doctor-info">
                <h3>Dr. Sarah Johnson</h3>
                <p>Neurologist</p>
            </div>
        </div>

        <div class="doctor-card">
            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=800" alt="">
            <div class="doctor-info">
                <h3>Dr. David Wilson</h3>
                <p>Orthopedic Surgeon</p>
            </div>
        </div>

    </div>

</section>

<!-- Booking Section -->
    <section class="booking-section" id="appointment">
        <div class="container">
            <div class="booking-container">
                <div class="booking-form animate-on-scroll animated">
                    <h3>BOOK APPOINTMENT</h3>
                    <form action="book.php" method="POST">
                    
                        <div class="form-group">
                            <label for="name">Patient's Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Patient's Address</label>
                            <input type="text" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">
                                Select doctor</label>
                                <select id="doctor_id" name="doctor_id" required>
                                    <option value="">
                                        Select Doctor
                                    </option>
                                    
                                    <?php
                                    $getDoctors = mysqli_query($conn,
                                    "SELECT id, doctor_name FROM doctors WHERE status='Active' ORDER BY doctor_name ASC");
                                    
                                    while($doctor = mysqli_fetch_assoc($getDoctors)){
                                    ?>
                                    
                                    <option value="<?php echo $doctor['id']; ?>">
                                        <?php echo $doctor['doctor_name']; ?>
                                    </option>
                                    
                                    <?php
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="date">Age</label>
                                <input type="number" id="age" name="age" min="1" max="120" required>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label>Appointment Date</label>
                            <input type="date" id="appointment_date" name="appointment_date" required>
                        </div>

                        <!-- Dynamic Time Slots -->
                         
                        <div class="form-group">                   
                            <label for="appointment_time">
                                Available Time Slots
                            </label>
                            
                            <select id="appointment_time" name="appointment_time" required>
                                <option value="">
                                    Select Doctor & Date First
                                </option>
                                
                            </select>
                        </div>
                        
                        <!-- Reason -->
                        <div class="form-group">
                            <label for="reason">Reason for Visit</label>
                            <textarea id="reason" name="reason" rows="3" placeholder="Briefly describe your symptoms or reason for appointment"></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Book Appointment</button>
                    </form>
                    <button type="submit" class="btn-secondary" onclick="document.location='view_my_appointment.html'">View your appointment</button>
                </div>

                <div class="booking-info animate-on-scroll animated">
                    

                    <div class="info-card">
                        <h3>Need Help?</h3>
                        <p><strong>If you need assistance with booking your appointment, please contact us:</strong></p>
                        <div class="contact-item">
                            <span class="icon">📞</span>
                            <a href="tel:+917252844411" style="color: inherit; text-decoration: none;">+91 7252844411</a>

                        </div>
                        <div class="contact-item">
                            <span class="icon">✉️</span>
                            <span><a href="mailto:himanshusaini1407@gmail.com">himanshusaini1407@gmail.com</a></span>
                        </div>
                        <div class="contact-item">
                            <span class="icon">⏰</span>
                            <span>Mon-Sat: 08:00 AM - 08:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Testimonials -->

<section class="testimonials">

    <div class="section-title">
        <span>TESTIMONIALS</span>
        <h2>What Our Patients Say</h2>
    </div>

    <div class="testimonial-slider">

        <div class="testimonial active">
            <p>
                "Excellent doctors and staff. The treatment and care
                were outstanding."
            </p>
            <h4>- Robert Williams</h4>
        </div>

        <div class="testimonial">
            <p>
                "Very professional hospital with modern facilities and
                quick service."
            </p>
            <h4>- Emily Johnson</h4>
        </div>

        <div class="testimonial">
            <p>
                "I highly recommend this hospital for quality treatment."
            </p>
            <h4>- James Brown</h4>
        </div>

    </div>

</section>

<!-- FAQ -->

<section class="faq">

    <div class="section-title">
        <span>FAQ</span>
        <h2>Frequently Asked Questions</h2>
    </div>

    <div class="faq-container">

        <div class="faq-item">

            <div class="faq-question">
                Do you provide emergency services?
                <i class="fa-solid fa-plus"></i>
            </div>

            <div class="faq-answer">
                Yes, our emergency department operates 24/7.
            </div>

        </div>

        <div class="faq-item">

            <div class="faq-question">
                How can I book an appointment?
                <i class="fa-solid fa-plus"></i>
            </div>

            <div class="faq-answer">
                You can book online through our website.
            </div>

        </div>

        <div class="faq-item">

            <div class="faq-question">
                Are specialist doctors available?
                <i class="fa-solid fa-plus"></i>
            </div>

            <div class="faq-answer">
                Yes, we have experienced specialists in multiple departments.
            </div>

        </div>

    </div>

</section>

<!-- Contact Section -->

<section class="contact" id="contact">

    <div class="section-title">
        <span>CONTACT US</span>
        <h2>Get In Touch</h2>
    </div>

    <div class="contact-container">

        <div class="contact-info">

            <div class="contact-box">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h3>Address</h3>
                    <p>123 Medical Street, New Delhi, India</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h3>Phone</h3>
                    <p>+91 9876543210</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    <p>info@medicarehospital.com</p>
                </div>
            </div>

        </div>

        <form class="contact-form">

            <input type="text" placeholder="Your Name">

            <input type="email" placeholder="Email Address">

            <textarea rows="6"
                placeholder="Write Your Message"></textarea>

            <button type="submit">
                Send Message
            </button>

        </form>

    </div>

</section>

<!-- Google Map -->

<section class="map">

    <iframe
        src="https://www.google.com/maps/embed?pb="
        allowfullscreen=""
        loading="lazy">
    </iframe>

</section>

<!-- Footer -->

<footer>

    <div class="footer-container">

        <div class="footer-col">
            <h3>Medicare Hospital</h3>

            <p>
                Dedicated to providing world-class healthcare
                with compassion and excellence.
            </p>
        </div>

        <div class="footer-col">
            <h3>Quick Links</h3>

            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#doctor">Doctors</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="footer-col">
            <h3>Services</h3>

            <a href="#Cardiology">Cardiology</a>
            <a href="#Neurology">Neurology</a>
            <a href="#Neurology">Orthopedics</a>
            <a href="#">Emergency Care</a>
        </div>

    </div>

    <div class="copyright">
        © 2026 Medicare Hospital | All Rights Reserved
    </div>

</footer>

<!-- WhatsApp Button -->

<a href="https://wa.me/917252844411" class="whatsapp-btn">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- Scroll Top -->

<button id="scrollTop">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Theme Toggle -->



    <script src="script.js"></script>

</body>

</html>
