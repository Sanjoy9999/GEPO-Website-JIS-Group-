document.addEventListener("DOMContentLoaded", () => {
  // adding favicon for all page
  const link = document.createElement("link");
  link.rel = "shortcut icon";
  link.href = `${
    location.pathname.includes("index.html") ? "." : ".."
  }/assets/images/logo.png`;
  link.type = "image/x-icon";
  document.head.appendChild(link);
});
