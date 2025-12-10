document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("form");
    if (!form) {
        console.error('No form found on the page');
        return;
    }

    form.addEventListener("submit", async function(event) {
        event.preventDefault();
        const email          = document.getElementById("email").value;
        const last_password  = document.getElementById("lastPassword").value;
        const new_password   = document.getElementById("newPassword").value;
        const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(new_password);
        if(!isValid)
        {
            document.getElementById("invalid").innerText = "Invalid new password format."
            document.getElementById("invalid").style.display = "block";
            return;
        }
        if(last_password === new_password)
        {
            document.getElementById("invalid").innerText = "New and last password can't be equal."
            document.getElementById("invalid").style.display = "block";
            return;
        }
        try {
            const res = await fetch('forgot.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, last_password, new_password })
            });

            const data = await res.json();
            console.log('Response:', data);

            if (data.success) {
                console.log('Change success:', data.message);
                window.location.href = 'login.html';
            } else {
                document.getElementById("invalid").innerText= "Account does not exist."
                document.getElementById("invalid").style.display = "block";
                console.warn('Change failed:', data.message);
            }
        } catch (err) {
            console.error('Change error:', err);
            document.getElementById("invalid").innerText = err;
            document.getElementById("invalid").style.display = "block";
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
}}
