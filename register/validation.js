let confirmed = false;

document.getElementById("pw").addEventListener("input", function() {
    const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(this.value);
    document.getElementById("password-validation").style.display = isValid ? 'none' : 'block';
    if(isValid) confirmed = true;
});

function confirm() {
    if (confirmed && document.getElementById("pw").value === document.getElementById("confirm-password").value) {
        registerUser();
    } else {
        alert('Please enter a valid password before registering.');
    }
}

async function registerUser() {
    const userData = {
        fname: document.getElementById("fname").value,
        lname: document.getElementById("lname").value,
        email: document.getElementById("email").value,
        pw: document.getElementById("pw").value
    };

    try {
        const res = await fetch("register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(userData)
        });

        const data = await res.json();

        if (data.success) {
            alert("Registration successful!");
            window.location.href = "../home.html";
        } else {
            document.getElementById("acc").style.display = "block";
            alert("Error: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Network or server error.");
    }
}

