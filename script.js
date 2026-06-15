
const displayAlert = (msg, statusType) => {
    const box = document.getElementById("alertBox");
    if(!box) return;

    box.textContent = msg;
    box.className = `alert ${statusType}`;
};


document.getElementById("registerForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formData = new FormData();
    formData.append("name", document.getElementById("name").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("password", document.getElementById("password").value);

    displayAlert("Processing registration...", "success");

    try {
        let res = await fetch("register.php", { method: "POST", body: formData });
        let data = await res.text();

        if(data.trim() === "success"){
            displayAlert("Registered successfully! Redirecting...", "success");
            setTimeout(() => { window.location.href = "login.html"; }, 1500);
        }
        else if(data.trim() === "exists"){
            displayAlert("This email is already registered!", "error");
        }
        else{
            displayAlert("Registration failed. Please try again.", "error");
        }
    } catch (err) {
        displayAlert("Server communication error.", "error");
    }
});



document.getElementById("loginForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    let formData = new FormData();
    formData.append("email", document.getElementById("loginEmail").value);
    formData.append("password", document.getElementById("loginPassword").value);

    try {
        let res = await fetch("login.php", { method: "POST", body: formData });
        let data = await res.text();

        if(data.trim() === "success"){
            displayAlert("Login verified! Launching workspace...", "success");
            setTimeout(() => { window.location.href = "dashboard.php"; }, 1000);
        }
        else if(data.trim() === "wrong"){
            displayAlert("Incorrect password. Please try again.", "error");
        }
        else {
            displayAlert("User account not found.", "error");
        }
    } catch (err) {
        displayAlert("Server communication error.", "error");
    }
});