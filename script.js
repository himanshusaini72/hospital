/* ==========================
   MOBILE MENU
========================== */

const menuBtn = document.querySelector(".menu-btn");
const navLinks = document.querySelector(".nav-links");

if (menuBtn && navLinks) {
    menuBtn.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
}

/* ==========================
   NAVBAR SCROLL EFFECT
========================== */

window.addEventListener("scroll", () => {

    const navbar = document.querySelector(".navbar");

    if (!navbar) return;

    if (window.scrollY > 50) {
        navbar.style.background = "#0f172a";
    } else {
        navbar.style.background = "rgba(255,255,255,0.15)";
    }

});

/* ==========================
   COUNTER ANIMATION
========================== */

const counters = document.querySelectorAll(".counter");

counters.forEach(counter => {

    const updateCounter = () => {

        const target = +counter.getAttribute("data-target");
        const count = +counter.innerText;

        const increment = Math.max(1, target / 200);

        if (count < target) {

            counter.innerText = Math.ceil(count + increment);

            setTimeout(updateCounter, 10);

        } else {

            counter.innerText = target;

        }
    };

    updateCounter();

});

/* ==========================
   FAQ TOGGLE
========================== */

const faqItems = document.querySelectorAll(".faq-item");

faqItems.forEach(item => {

    const question = item.querySelector(".faq-question");

    if (question) {

        question.addEventListener("click", () => {

            item.classList.toggle("active");

        });

    }

});

/* ==========================
   TESTIMONIAL SLIDER
========================== */

const testimonials = document.querySelectorAll(".testimonial");

if (testimonials.length > 0) {

    let currentSlide = 0;

    setInterval(() => {

        testimonials[currentSlide].classList.remove("active");

        currentSlide++;

        if (currentSlide >= testimonials.length) {
            currentSlide = 0;
        }

        testimonials[currentSlide].classList.add("active");

    }, 4000);

}

/* ==========================
   SCROLL TO TOP
========================== */

const scrollBtn = document.getElementById("scrollTop");

if (scrollBtn) {

    window.addEventListener("scroll", () => {

        if (window.scrollY > 500) {
            scrollBtn.style.display = "flex";
        } else {
            scrollBtn.style.display = "none";
        }

    });

    scrollBtn.addEventListener("click", () => {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}

// Form input interactions
const form = document.querySelector('form');
const inputs = form.querySelectorAll('input, select, textarea');

inputs.forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('focused');
    });

    input.addEventListener('blur', () => {
        if (!input.value) {
            input.parentElement.classList.remove('focused');
        }
    });
});

// Time slot click interaction
document.querySelectorAll('.slot.available').forEach(slot => {

    slot.addEventListener('click', () => {

        document.querySelectorAll('.slot.selected').forEach(s => {
            s.classList.remove('selected');
        });

        slot.classList.add('selected');

        document.getElementById('appointment_time').value =
            slot.textContent.trim();

    });

});

form.addEventListener("submit", function (e) {

    const selectedTime =
        document.getElementById("appointment_time").value;

    if (!selectedTime) {
        e.preventDefault();
        alert("Please select a time slot.");
    }

});

// Add selected slot style dynamically
const style = document.createElement('style');
style.textContent = `.slot.selected {
                    background-color: #0066ff !important;
                    color: white !important;
                    transform: scale(1.05);
                    box-shadow: 0 4px 12px rgba(0,102,255,0.3);
                }`;
document.head.appendChild(style);



