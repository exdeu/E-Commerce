document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("form");
    if (!form) {
        console.error('No form found on the page');
        return;
    }

    form.addEventListener("submit", async function(event) {
        event.preventDefault();
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        try {
            const res = await fetch('login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });

            const data = await res.json();

            if (data.status === 'success') {
                window.location.href = '../home.html';
                console.log('Login success:', data.message);
            } else {
                document.getElementById("invalid").style.display = "block";
                console.warn('Login failed:', data.message);
            }
        } catch (err) {
            console.error('Login error:', err);
        }
    });
});
function togglePassword(inputId, el) {
    const input = document.getElementById(inputId);
    const icon = el.querySelector('i');
    if (!input) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        input.type = "password";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}