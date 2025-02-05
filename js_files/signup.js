const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm_password").value;

  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(email.trim())) {
    alert("Please enter a valid email address.");
    return;
  }

  if (password.trim().length < 8) {
    alert("Password must be at least 8 characters long.");
    return;
  }

  if (password !== confirmPassword) {
    alert("Passwords do not match.");
    return;
  }

  const formData = new FormData(form);

  // make api request
  try {
    const response = await axios.post("/users", formData);

    const data = response.data.data;
    console.log(data);
    alert("User signup successfully.");
  } catch (error) {
    error?.response?.data?.message || "Something went wrong";
    console.error(errorMessage);
    alert(errorMessage);
    return;
  }

  form.reset();
});
