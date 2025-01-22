document.addEventListener('DOMContentLoaded', () => {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Mobile menu toggle
    const mobileMenuToggle = document.createElement('button');
    mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    mobileMenuToggle.classList.add('mobile-menu-toggle');
    document.querySelector('nav').appendChild(mobileMenuToggle);

    mobileMenuToggle.addEventListener('click', () => {
        document.querySelector('nav ul').classList.toggle('show');
    });

    // Animate on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.animate-on-scroll');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (elementTop < windowHeight - 100) {
                element.classList.add('animated');
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Initial check on page load
});







document.addEventListener("DOMContentLoaded", () => {
    // Existing code...
  
    // Admin-specific functionality
    if (window.location.pathname.includes("admin.html")) {
      const adminSidebarLinks = document.querySelectorAll(".admin-sidebar a")
      adminSidebarLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault()
          const sectionId = this.getAttribute("href").substring(1)
          alert(`Navigating to ${sectionId} section. This would typically load the corresponding admin panel section.`)
        })
      })
  
      // Simulate data loading for admin dashboard
      setTimeout(() => {
        document.querySelectorAll(".stat-card p").forEach((stat) => {
          stat.style.opacity = "0"
          stat.style.transform = "translateY(-20px)"
          stat.style.transition = "opacity 0.5s ease, transform 0.5s ease"
          setTimeout(() => {
            stat.style.opacity = "1"
            stat.style.transform = "translateY(0)"
          }, 300)
        })
      }, 1000)
    }
  })
  
  