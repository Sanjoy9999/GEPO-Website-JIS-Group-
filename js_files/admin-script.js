
document.addEventListener("DOMContentLoaded", () => {
  // Simulating data loading
  // fetch Data from database
  setTimeout(() => {
    document.getElementById("activePartnerships").textContent = "42";
    document.getElementById("ongoingPrograms").textContent = "15";
    document.getElementById("upcomingEvents").textContent = "8";
    document.getElementById("pendingApplications").textContent = "23";
  }, 1000);

  // Chart.js implementation
  const ctx = document.getElementById("applicationsChart").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      datasets: [
        {
          label: "Applications Received",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: "rgba(0, 123, 255, 0.5)",
          borderColor: "rgba(0, 123, 255, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  // Simulating recent activities
  const recentActivities = [
    "New partnership application received from University XYZ",
    "Study Abroad Program for Fall 2023 published",
    "Faculty Exchange Program with ABC University approved",
    "5 new student applications for International Summer School",
    "Annual Report for 2022 generated",
  ];

  const recentActivitiesList = document.getElementById("recentActivitiesList");
  recentActivities.forEach((activity) => {
    const li = document.createElement("li");
    li.textContent = activity;
    recentActivitiesList.appendChild(li);
  });

  // Generate Report button functionality
  document.getElementById("generateReportBtn").addEventListener("click", () => {
    alert(
      "Generating comprehensive report... This feature would typically create a detailed PDF or Excel report of all activities, partnerships, and program statistics."
    );
  });

});
