document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const errorBox = document.getElementById('clientError');

    if (!form) return;

    form.addEventListener('submit', (event) => {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        const errors = [];

        if (name.length < 2) errors.push('Name must be at least 2 characters.');
        if (!/^\S+@\S+\.\S+$/.test(email)) errors.push('Enter a valid email address.');
        if (message.length < 10) errors.push('Message must be at least 10 characters.');

        if (errors.length) {
            event.preventDefault();
            errorBox.textContent = errors.join(' ');
            errorBox.classList.remove('d-none');
        }
    });
});
