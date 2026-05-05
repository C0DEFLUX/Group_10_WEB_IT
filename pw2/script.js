/* ---------------------------------------------------------
   1. NAVBAR SCROLL EFFECT
--------------------------------------------------------- */
const navbar = document.getElementById("mainNavbar");

window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        navbar.classList.add("navbar-scrolled");
    } else {
        navbar.classList.remove("navbar-scrolled");
    }
});


/* ---------------------------------------------------------
   2. DARK / LIGHT MODE TOGGLE (with LocalStorage)
--------------------------------------------------------- */
const body = document.getElementById("body");
const themeToggle = document.getElementById("themeToggle");

function applyTheme(theme) {
    if (theme === "dark") {
        body.classList.add("dark-mode");
        themeToggle.textContent = "Light Mode";
    } else {
        body.classList.remove("dark-mode");
        themeToggle.textContent = "Dark Mode";
    }
}

// Load saved theme
const savedTheme = localStorage.getItem("theme") || "light";
applyTheme(savedTheme);

// Toggle theme
themeToggle.addEventListener("click", () => {
    const newTheme = body.classList.contains("dark-mode") ? "light" : "dark";
    applyTheme(newTheme);
    localStorage.setItem("theme", newTheme);
});


/* ---------------------------------------------------------
   3. SERVICE FILTERING (services.html)
--------------------------------------------------------- */
const filterInput = document.getElementById("serviceFilter");
const serviceCards = document.querySelectorAll(".service-card");

if (filterInput) {
    filterInput.addEventListener("input", () => {
        const keyword = filterInput.value.toLowerCase();

        serviceCards.forEach(card => {
            const text = card.dataset.name.toLowerCase();
            card.style.display = text.includes(keyword) ? "block" : "none";
        });
    });
}


/* ---------------------------------------------------------
   4. CONTACT FORM VALIDATION (contact.html)
--------------------------------------------------------- */
const contactForm = document.getElementById("contactForm");
const formAlert = document.getElementById("formAlert");

function showAlert(message, type = "danger") {
    formAlert.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
}

if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const name = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();

        // Validation
        if (!name || !email || !message) {
            showAlert("All fields are required.");
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showAlert("Please enter a valid email address.");
            return;
        }

        if (message.length < 10) {
            showAlert("Message must be at least 10 characters long.");
            return;
        }

        // Success
        showAlert("Message sent successfully!", "success");
        contactForm.reset();
    });
}


/* ---------------------------------------------------------
   5. FOOTER YEAR + HOVER EFFECT
--------------------------------------------------------- */
const yearSpan = document.getElementById("year");
const footer = document.getElementById("footer");

// Dynamic year
yearSpan.textContent = new Date().getFullYear();

// Hover effect
footer.addEventListener("mouseenter", () => {
    footer.style.backgroundColor = "#1a2333";
});
footer.addEventListener("mouseleave", () => {
    footer.style.backgroundColor = "";
});
