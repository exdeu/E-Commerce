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
