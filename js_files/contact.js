// form submission handling
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
const form = document.querySelector("#contact-container form");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(form);
  const data = Object.fromEntries(formData);

  console.log(data);
  // make api request
});
