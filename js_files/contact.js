// faq section script
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
const faq = [
  {
    summary: "How do I apply for a study abroad program?",
    content:
      "Visit our Programs & Initiatives page and follow the application process for your chosen program.",
  },
  {
    summary:
      "What financial aid options are available for international students?",
    content:
      "We offer various scholarships and grants. Check our Resources & Support page for more information.",
  },
  {
    summary: "How can faculty members participate in exchange programs?",
    content:
      "Faculty can explore opportunities on our Faculty & Research Exchange section under Programs & Initiatives.",
  },
];

initializeDetails(faq);

// form validation
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
const form = document.querySelector("#contact-container form");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(form);
  const data = Object.fromEntries(formData);

  console.log(data);
  // make api request
});
