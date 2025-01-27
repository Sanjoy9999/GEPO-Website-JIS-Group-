document.addEventListener("DOMContentLoaded", () => {
  // adding favicon for all page
  const link = document.createElement("link");
  link.rel = "shortcut icon";
  link.href = `${
    location.pathname.includes("index.html") ? "." : ".."
  }/assets/images/logo.png`;
  link.type = "image/x-icon";
  document.head.appendChild(link);

  // Animate on scroll
  const animateOnScroll = () => {
    const elements = document.querySelectorAll(".animate-on-scroll");
    elements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;
      if (elementTop < windowHeight - 130) {
        element.classList.add("animated");
      } else if (elementTop > windowHeight + 50) {
        element.classList.remove("animated");
      }
    });
  };

  window.addEventListener("scroll", animateOnScroll);
  animateOnScroll(); // Initial check on page load
});

// hamburger section
let hamburger = document.querySelector(".hamburger");
let navBar = document.querySelector("#navBar");
console.log(hamburger);
let menuOpen = false;

hamburger.addEventListener("click", (e) => {
  console.log("Hamburger clicked");
  if (!menuOpen) {
    navBar.style.left = "0"; // Show the menu
    e.target.style.transform = "rotate(180deg)";
  } else {
    navBar.style.left = "100%"; // Hide the menu
    e.target.style.transform = "rotate(-180deg)";
  }
  menuOpen = !menuOpen;
});
