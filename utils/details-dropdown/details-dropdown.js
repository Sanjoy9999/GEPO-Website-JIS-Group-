/* 
<div id="details-container">
  <div class="details-box animate-on-scroll">
    <div class="details-summary">
      <h5>Summary of the content.</h5>
      <span>+</span>
    </div>
    <div class="details-content">
      <p>
        Content here
      </p>
    </div>
  </div>
</div>
*/

function initializeDetails(details = []) {
  const container = document.getElementById("details-container");

  details.forEach((detail) => {
    const html = `
  <div class="details-box animate-on-scroll">
    <div class="details-summary">
      <h5>${detail.summary}</h5>
      <span>+</span>
    </div>
    <div class="details-content">
      <p>
        ${detail.content}
      </p>
    </div>
  </div>
    `;

    container.innerHTML += html;
  });

  const detailSummaries = document.querySelectorAll(".details-summary");

  detailSummaries.forEach((summary) => {
    const parent = summary.parentElement;
    const content = parent.querySelector(".details-content");

    summary.addEventListener("click", () => {
      if (parent.classList.contains("open")) {
        // Closing the content
        content.style.height = "0";
        parent.classList.remove("open");
      } else {
        // Opening the content
        const contentHeight = content.scrollHeight + "px";
        parent.classList.add("open");
        content.style.height = contentHeight;
      }
    });
  });
}
