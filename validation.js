const passwordInput = document.getElementById('pw');
const validationMessage = document.getElementById('password-validation');
let confirmed = false;
passwordInput.addEventListener('input', function() {
    const password = passwordInput.value;
    const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);
    validationMessage.style.display = isValid ? 'none' : 'block';
    if(isValid) confirmed = true;
});

function confirm() {
    if (confirmed) {
        document.getElementById('reg').submit();
    } else {
        alert('Please enter a valid password before registering.');
    }
}