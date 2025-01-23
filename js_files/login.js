document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email.trim() === "" || password.trim() === "") {
      alert("Please enter both email and password.");
      return;
    }

    console.log("Login attempt:", { email, password });
    alert("Login functionality would be implemented on the server-side.");

    loginForm.reset();
  });
});
