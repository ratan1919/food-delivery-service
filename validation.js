document.getElementById("signup-form").addEventListener("submit", function (event) {
    let password = document.querySelector("input[name='password']").value;
    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        event.preventDefault();
    }
});
