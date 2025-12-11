document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("form");
    if (!form) {
        console.error('No form found on the page');
        return;
    }

    form.addEventListener("submit", async function(event) {
        event.preventDefault();
        const email          = String(document.getElementById("email").value);
        const new_password   = String(document.getElementById("newPassword").value);
        const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(new_password);
        if(!isValid)
        {
            document.getElementById("invalid").innerText = "Invalid new password format."
            document.getElementById("invalid").style.display = "block";
            return;
        }
        try {
            const res = await fetch('forgot.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, new_password })
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

