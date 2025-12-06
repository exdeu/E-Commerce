async function checkLogin(path) {
    try {
        const res = await fetch(path, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        });

        const data = await res.json();

        if (data.status === 'success') {
            document.getElementById('profile').style.display = 'block';
            document.getElementById('cart').style.display = 'block';  
            log_stat =  document.getElementById('log_stat');
            log_stat.textContent = 'Log Out';
            log_stat.href = log_stat.href.length > 0 ? log_stat.href + 'logout.php' : 'logout.php';
            log_stat.logged = true;
        } else {
            document.getElementById('profile').style.display = 'none';
            document.getElementById('cart').style.display = 'none';  
            log_stat =  document.getElementById('log_stat');
            log_stat.textContent = 'Log In';
            log_stat.href = log_stat.href.length > 0 ? log_stat.href + 'login.html' : 'login.html';
            console.warn("User not logged in."); 
             log_stat.logged = false;
        }

    } catch (error) {
        console.error("Error checking login:", error);
    }
}
