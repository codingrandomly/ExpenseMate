document.addEventListener("DOMContentLoaded", () => {
  setupNavbarToggle();
  setupFormValidation();
  setupSmoothScroll();
});

function setupNavbarToggle() {
  const navbarToggle = document.querySelector(".navbar-toggle");
  const navLinks = document.querySelector(".navbar ul");

  if (navbarToggle && navLinks) {
    navbarToggle.addEventListener("click", () => {
      navLinks.classList.toggle("active");
      navbarToggle.classList.toggle("open");
    });
  }
}

function setupFormValidation() {
  const forms = document.querySelectorAll("form[data-validate='true']");

  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      let valid = true;

     
      const inputs = form.querySelectorAll("input[required]");
      inputs.forEach((input) => {
        if (input.value.trim() === "") {
          valid = false;
          input.classList.add("input-error");
        } else {
          input.classList.remove("input-error");
        }
      });

      if (!valid) {
        e.preventDefault();
        showAlert("Please fill in all required fields.", "error");
      }
    });
  });
}

function setupSmoothScroll() {
  const links = document.querySelectorAll("a[href^='#']");
  links.forEach((link) => {
    link.addEventListener("click", function (e) {
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({
          behavior: "smooth",
        });
      }
    });
  });
}

function showAlert(message, type = "success") {
  const existingAlert = document.querySelector(".custom-alert");
  if (existingAlert) existingAlert.remove();

  const alert = document.createElement("div");
  alert.className = `custom-alert ${type}`;
  alert.textContent = message;

  document.body.appendChild(alert);
s
  setTimeout(() => alert.remove(), 3000);
}

const style = document.createElement("style");
style.innerHTML = `
.input-error {
    border: 1px solid #ff6b6b !important;
}
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #333;
    color: #fff;
    padding: 0.8rem 1.2rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    z-index: 10000;
    opacity: 0.95;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}
.custom-alert.success { border-left: 5px solid #4CAF50; }
.custom-alert.error { border-left: 5px solid #ff6b6b; }
`;
document.head.appendChild(style);
