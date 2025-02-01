// form submission handling
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
const form = document.querySelector("#contact-container form");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(form);

  console.log(formData);
  // make api request
  try {
    form.querySelector("#submitBtn").disabled = true;
    // /contact-application POST
    const response = await axios.post("/contact-application", formData);

    const data = response.data.data;
    console.log(data);
    alert("Your message has been sent successfully!");
    form.reset();
    form.querySelector("#submitBtn").disabled = false;
  } catch (error) {
    console.error(error);
    form.querySelector("#submitBtn").disabled = false;
  }
});
