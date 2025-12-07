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
    async function loadCheckout() {
    let data;

    try {
        const res = await fetch('checkout.php', {
            method: "POST"
        });

        data = await res.json();

        if (!data.success) {
            alert("Error: " + (data.message || "Checkout failed"));
            return;
        }

        console.log("Checkout data:", data.data);

    } catch (err) {
        console.error("Checkout load error:", err);
        alert("Error loading checkout data.");
        return;
    }

    // Now data.success === true and data.data is an array
    const tb = document.getElementById("checkout");
    if (!tb) {
        console.error('No tbody with id "checkout-body" found.');
        return;
    }

    tb.innerHTML = ''; // clear previous rows

    data.data.forEach(row =>  {  
        const price  = Number(row.price);
        const count  = Number(row.count);
        const total  = price * count;

        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${row.order_id}</td>
            <td>${row.time_stamp}</td>
            <td>$${total.toFixed(2)}</td>
            <td><span class="badge bg-info">Shipping</span></td>
        `;
        tb.appendChild(tr);
    });
}

    profile();
    loadCheckout();
});
