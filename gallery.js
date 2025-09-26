

/*document.querySelectorAll('.gallery img').forEach(img => {
  img.addEventListener('mouseenter', () => {
    img.style.transform = 'scale(1.05)';
    img.style.transition = 'transform 0.3s ease';
  });

  img.addEventListener('mouseleave', () => {
    img.style.transform = 'scale(1)';
  });
});


const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

hamburger.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});
*/

  





window.addEventListener("DOMContentLoaded", () => {
  fetch("navbar.html")
    .then((res) => res.text())
    .then((data) => {
      document.getElementById("navbar-container").innerHTML = data;

      const currentPage = window.location.pathname.split("/").pop();
      const navLinks = document.querySelectorAll(".nav-links a");

      navLinks.forEach((link) => {
        const href = link.getAttribute("href");
        if (href === currentPage) {
          const li = link.closest("li");
          if (li) li.classList.add("active");

          const dropdown = link.closest(".dropdown");
          if (dropdown) dropdown.classList.add("active");
        }
      });
    });

  fetch("footer.html")
    .then((res) => res.text())
    .then((data) => {
      document.body.insertAdjacentHTML("beforeend", data);
    });
});


function toggleMenu() {
      const nav = document.getElementById("navLinks");
      nav.classList.toggle("show");
    }




    const servicesDropdown = document.getElementById('servicesDropdown');
    const arrow = servicesDropdown.querySelector('.arrow');

    arrow.addEventListener('click', (e) => {
      e.stopPropagation(); // prevent bubbling
      servicesDropdown.classList.toggle('active');
    });

    // Optional: Click outside to close
    document.addEventListener('click', function (event) {
      if (!servicesDropdown.contains(event.target)) {
        servicesDropdown.classList.remove('active');
      }
    });



    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    // const servicesDropdown = document.getElementById('servicesDropdown');

    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });

    servicesDropdown.addEventListener('click', () => {
      servicesDropdown.classList.toggle('active');
    });
