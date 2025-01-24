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

// JavaScript for Carousel
if (location.pathname.includes("index.html")) {
  const images = document.querySelectorAll(".carousel img");
  let currentIndex = 0;

  function showImage(index) {
    images.forEach((img, i) => {
      img.classList.toggle("active", i === index);
    });
  }

  document.getElementById("prev").addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
  });

  document.getElementById("next").addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  }, 3000); // Change interval to 2 seconds
}
