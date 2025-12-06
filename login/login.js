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
