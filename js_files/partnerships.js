const form = document.querySelector("form");
const inputField = document.querySelectorAll(".input-field");
const formError = document.getElementById("form-error");

function onError(field, message) {
  const parentField = field.parentElement;

  parentField.classList.add("error");
  parentField.classList.remove("success");
  const errorElement = parentField.querySelector(".error-message");
  errorElement.textContent = message;
}

function onSuccess(field) {
  const parentField = field.parentElement;

  parentField.classList.remove("error");
  parentField.classList.add("success");
  formError.style.display = "none";
  const errorElement = parentField.querySelector(".error-message");
  errorElement.textContent = "";
}

inputField.forEach((field) => {
  field.addEventListener("input", (e) => {
    const value = field.value.trim();
    const name = field.name.split("-").join(" ");

    if (value === "") {
      const message = `${name} is Required`;
      onError(field, message);
    } else if (field.type !== "email" && value.length < 3) {
      onError(field, `${name} must be at least 3 characters long`);
    } else {
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (field.type === "email" && !emailPattern.test(value)) {
        onError(field, `Email Is Invalid`);
      } else {
        onSuccess(field);
      }
    }
  });
});

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const successFields = document.querySelectorAll(".success");
  console.log(inputField.length, successFields.length);

  if (successFields.length !== inputField.length) {
    formError.style.display = "block";
    formError.textContent = "Please fill in all required fields.";
    return;
  }

  formError.style.display = "none";
  const formData = new FormData(form);
  const data = Object.fromEntries(formData.entries());
  console.log(data);
  form.reset();
});
