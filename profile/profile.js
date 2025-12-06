document.addEventListener('DOMContentLoaded', async () => {

    async function profile() {
        try {
            const res = await fetch('../get_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            });

            const data = await res.json();

            if (data.status === 'success') {
                if (document.querySelector("#name"))
                    document.querySelector("#name").innerHTML = `${data.fname} ${data.lname}`;

                if (document.querySelector("#email"))
                    document.querySelector("#email").innerHTML = `<strong>Email:</strong> ${data.email}`;

                if (document.querySelector("#date"))
                    document.querySelector("#date").innerHTML = `<strong>Member Since:</strong> ${data.date}`;

                console.log("User is logged in:", data);
            } else {
                console.warn("User not logged in.");
                window.location.href = "../login/login.html"; 
            }

        } catch (error) {
            console.error("Error checking login:", error);
        }
    }

    profile();
});
