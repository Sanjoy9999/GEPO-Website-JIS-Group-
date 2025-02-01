// document.getElementById('addProgramBtn').addEventListener('click', function() {
//     alert('Add New Program form would appear here. This would include fields for program name, type, duration, partner institutions, and other relevant details.');
// });

const form = document.querySelector("form");
const addProgramBtn = form.querySelector("#addProgramBtn");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(form);
  // make api request
  addProgramBtn.disabled = true;
  try {
    const response = await axios.post("/study-abroad-programs", formData);
    const data = response.data.data;
    console.log(data);
    printPrograms();
    alert("Program has been added successfully!");
    addProgramBtn.disabled = false;
  } catch (error) {
    console.error(error);
    alert("Error adding program. Please try again.");
    addProgramBtn.disabled = false;
    return;
  }

  form.reset();
});

const programListContainer = document.getElementById("programs-list");
async function printPrograms() {
  try {
    const response = await axios.get("/study-abroad-programs");
    const data = response.data.data;
    console.log(data);
    data.forEach((program) => {
      console.log(program);
      programListContainer.innerHTML += `
       <div class="program-item">
              <div class="program-image">
                <img
                  src="http://localhost:8080${program.image}"
                  alt="Program Image"
                  width="200"
                />
              </div>
              <div class="program-info">
                <strong>${program.title}</strong> - ${program.institute}
                <div class="program-details program-time">Time: 5:00 PM</div>
                <div class="program-details program-date">
                  Date: 27th January 2025
                </div>
              </div>
              <div class="program-actions">
                <button class="edit-btn">Edit</button>
                <button class="delete-btn">Delete</button>
              </div>
            </div>`;
    });
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  printPrograms();
});

document.querySelectorAll(".edit-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const programName =
      this.closest(".program-item").querySelector("strong").textContent;
    alert(
      `Edit form for ${programName} would appear here. This would allow updating program details.`
    );
  });
});

document.querySelectorAll(".delete-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const programName =
      this.closest(".program-item").querySelector("strong").textContent;
    if (
      confirm(`Are you sure you want to delete the program "${programName}"?`)
    ) {
      alert(`Program "${programName}" has been deleted.`);
      this.closest(".program-item").remove();
    }
  });
});
